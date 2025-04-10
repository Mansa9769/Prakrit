<?php
$conn = new mysqli("localhost", "root", "", "user_auth");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'] ?? null;
$filter = $_GET['filter'] ?? null;

$books = [];

if ($type && $filter) {
    $stmt = $conn->prepare("SELECT * FROM books WHERE $type = ?");
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    $books = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books by <?php echo ucfirst($type); ?>: <?php echo htmlspecialchars($filter); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        
        body {
            background: linear-gradient(135deg, #f4e6d2, #e0c9a6); 
            font-family: 'Georgia';
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
        }

       
       
        h2 {
            text-align: center;
            font-size: 2.8rem;
            margin-bottom: 50px;
            color: #4b2e14;
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            max-width: 1000px;
            margin: auto;
        }

        .book-card {
            background: rgba(255, 248, 240, 0.9);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .book-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 70px;
            height: 70px;
            background: url('https://i.imgur.com/ZAV7P8T.png') no-repeat center;
            background-size: contain;
            opacity: 0.05;
            transform: rotate(-20deg);
        }

        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.15);
        }

        .book-card img {
    width: 100%; 
    height: 280px; 
    object-fit: contain; 
    border-radius: 12px; 
    margin-bottom: 15px; 
    background-color: #f9f3e8; 
}

        .book-card h4 {
            font-size: 1.3rem;
            margin: 12px 0 6px;
            color: #3e1e0e;
            font-family: 'Merriweather', serif;
        }

        .book-card p {
            margin: 4px 0;
            font-size: 14px;
            color: #5a4332;
            font-family: 'Segoe UI', sans-serif;
        }

        .view-btn {
            display: inline-block;
            margin-top: 14px;
            background-color: #7b4f34;
            color: #fff;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
            letter-spacing: 0.5px;
            transition: background 0.3s ease;
            font-family: 'Segoe UI', sans-serif;
        }

        .view-btn:hover {
            background-color: #5a3c28;
        }

        @media (max-width: 768px) {
            .book-grid {
                grid-template-columns: 1fr;
                padding: 0 20px;
            }
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
            font-weight: 100;
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

        * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
        }
        body {
            /* font-family: "Quintessential", cursive;
            font-family: "Times New Roman"; */
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
   
}.dropdown {
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


    <h2>Books by <?php echo ucfirst($type); ?>: "<?php echo htmlspecialchars($filter); ?>"</h2>
    <div class="book-grid">
        <?php if ($books && $books->num_rows > 0): ?>
            <?php while ($book = $books->fetch_assoc()): ?>
                <div class="book-card">
                    <img src="<?php echo $book['cover_url']; ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <h4><?php echo htmlspecialchars($book['title']); ?></h4>
                    <p><em><?php echo htmlspecialchars($book['author']); ?></em></p>
                    <p>Language: <?php echo htmlspecialchars($book['language']); ?></p>
                    <a class="view-btn" href="book.php?book_id=<?php echo $book['id']; ?>">View Details</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;">No books found for this filter.</p>
        <?php endif; ?>
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