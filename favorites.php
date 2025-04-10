<?php
session_start();
include 'db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch favorite books with full info
$sql = "SELECT b.*
        FROM favorites f
        JOIN books b ON f.book_id = b.id
        WHERE f.user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error executing query: " . $stmt->error);
}

if ($result->num_rows === 0) {
    echo "<p>No favorite books found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Favorites | Prakrit</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quintessential&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="auth.js"></script>
  <style>
    body {
      background: linear-gradient(135deg, #f8eee3, #e8d0b4);
      font-family: 'Georgia', serif;
      margin: 0;
      padding: 0px;
    }
    body {
            font-family: "Georgia";
            background: linear-gradient(135deg, #f4f4f9, #e0c3a1);
            color: #333;
            overflow-x: hidden;
        }
        nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #3e2217, #8a5a3c); /* Rich brown gradient */
    padding: 18px 50px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}
/* LOGO */
nav img {
    width: 85px;
    height: auto;
    transition: transform 0.3s ease-in-out;
}
nav img:hover {
    transform: scale(1.08);
}
/* SEARCH BAR (Borderless, More Sleek) */
nav .searchbar {
    display: flex;
    align-items: center;
    background: transparent;
    position: relative;
    width: 500px;
}
nav .searchbar input {
    width: 100%;
    height: 42px;
    padding: 0 45px;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    font-size: 16px;
    font-weight: 500;
}
nav .searchbar input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}
/* SEARCH ICON */
nav .searchbar i {
    position: absolute;
    left: 0px;
    color: white;
    font-size: 20px;
    transition: transform 0.3s ease;
}
nav .searchbar i:hover {
    transform: scale(1.15);
}
nav span {
    display: flex;
    align-items: center;
}
nav a ,.user{
    color: #ffefe0;
    text-decoration: none;
    margin: 0 18px;
    padding: 14px 18px;
    transition: all 0.3s ease-in-out;
    font-size: 16px;
}
nav a:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
    color: #ffefe0;
}
    h1 {
      text-align: center;
      color: #4a2e1f;
      margin-bottom: 30px;
    }
    .favorites-container {
      max-width: 1000px;
      margin: 0 auto;
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f4f4f9;
      color: #333;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    img {
      width: 100px;
      height: auto;
      border-radius: 5px;
    }
    .book-title a {
      color: #8a5a3c;
      text-decoration: none;
      font-weight: bold;
    }
    .book-title a:hover {
      text-decoration: underline;
    }
    footer {
            background: linear-gradient(135deg, #774c2e, #5a3e1b);
            color: #fff;
            padding: 40px 20px;
            margin-top: 40px;
        }
        .footer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .footer-logo img {
            width: 80px;
            height: 80px;
            transition: transform 0.3s ease;
        }
        .footer-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .footer-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .footer-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }
        .footer-social {
            display: flex;
            gap: 15px;
        }
        .footer-social a {
            font-size: 24px;
            color: #fff;
            transition: transform 0.3s ease;
        }
        .footer-social a:hover {
            transform: scale(1.2);
        }
        .footer-copyright p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }


        .dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    color: #ffefe0;
    
    text-decoration: none;
    margin: 0 18px;
    padding: 14px 18px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff9f3;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    border-radius: 10px;
    top: 100%;
    left: 0;
    
}

.dropdown-content a {
    margin-top: 15px;
    margin-bottom: 15px;
    color: #5a3e1b;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.dropdown-content a:hover {
    background-color: #fceee1;
    color:brown;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

  </style>
</head>
<body>
<nav>
        <img src="logo.png" alt="kkrloser">
        <form class="searchbar" method="get" action="search.php">
            <input type="text" name="q" placeholder="Search books" required>
            <button type="submit" style="background:none;border:none;position:absolute;left:15px;top:10px;">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <span>
            <a href="Home_new.html" target="content">Home</a>
            <div class="dropdown">
                <a href="#" class="dropbtn">Categorize</a>
                <div class="dropdown-content">
                  <a href="filter.php?type=genre">By Genre</a>
                  <a href="filter.php?type=language">By Language</a>
                </div>
              </div>
            <a href="favorites.php" target="content">Favourites</a>
            <a href="UserProfile.html" target="content"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
        </span>
    </nav>
    <br><br>
  <h1>Your Favorite Books</h1>
  <div class="favorites-container">
    <table>
      <thead>
        <tr>
          <th>Cover</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>Language</th>
          <th>Publisher</th>
          <th>Year Published</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($book = $result->fetch_assoc()): ?>
          <tr>
            <td><img src="<?= htmlspecialchars($book['cover_url']) ?>" alt="<?= htmlspecialchars($book['title']) ?>"></td>
            <td class="book-title"><a href="book.php?book_id=<?= $book['id'] ?>"><?= htmlspecialchars($book['title']) ?></a></td>
            <td><?= htmlspecialchars($book['author']) ?></td>
            <td><?= htmlspecialchars($book['genre']) ?></td>
            <td><?= htmlspecialchars($book['language']) ?></td>
            <td><?= htmlspecialchars($book['publisher']) ?></td>
            <td><?= htmlspecialchars($book['year_published']) ?></td>
            <td><?= nl2br(htmlspecialchars($book['description'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <footer>
    <div class="footer-container">
        <div class="footer-logo">
            <img src="logo.png" alt="kkrloser">
        </div>
        <div class="footer-links">
            <a href="contact.html">Contact Us</a>
            <a href="t&c.html">Terms and Conditions</a>
            <a href="privacy.html">Privacy Policy</a>
            <a href="about_us.html">About Us</a>
            <a href="#">Help</a>
        </div>
        <div class="footer-social">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
        </div>
        <div class="footer-copyright">
            <p>&copy; 2025 Book Suggestion Site. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>