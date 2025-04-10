<?php
include 'db_connect.php';

// Fetch all authors
$sql = "SELECT * FROM authors ORDER BY name";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Authors | Prakrit</title>
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="jquery-3.7.1.js"></script>
  <style>

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
   
}

    body {
      font-family: 'Georgia', serif;
      background: linear-gradient(120deg, #f8e8d6, #e7d3bd);
      margin: 0;
      padding: 0;
      color: #4b2e2e;
    }
   
    .container {
      max-width: 1000px;
      margin: 60px auto;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #3e2a1f;
      margin-bottom: 40px;
      font-size: 36px;
      letter-spacing: 1px;
    }

    .author-card {
      display: flex;
      flex-wrap: wrap;
      background-color: #fffaf4;
      border-radius: 16px;
      margin-bottom: 30px;
      padding: 24px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      gap: 24px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .author-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .author-card img {
      width: 180px;
      height: 240px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .author-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .author-details h2 {
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 24px;
      color: #4b2e2e;
    }

    .author-details p {
      margin: 5px 0;
      line-height: 1.6;
      font-size: 16px;
      color: #5a3f30;
    }

    .author-details strong {
      color: #3a241b;
    }

    .author-details small {
      color: #947c68;
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

  <div class="container">
    <h1>Authors of Prakrit</h1>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="author-card">
        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="author-details">
          <h2><?= htmlspecialchars($row['name']) ?></h2>
          <p><strong>Nationality:</strong> <?= htmlspecialchars($row['nationality']) ?></p>
          <p><strong>Born:</strong> <?= htmlspecialchars($row['birth_year']) ?> 
            <?php if ($row['death_year']): ?> | <strong>Died:</strong> <?= htmlspecialchars($row['death_year']) ?><?php endif; ?>
          </p>
          <p><?= nl2br(htmlspecialchars($row['bio'])) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="logo.png" alt="kkrloser">
            </div>
            <div class="footer-links">
                <a href="contact.html">Contact Us</a>
                <a href="def.html">Terms and Conditions</a>
                <a href="ghi.html">Privacy Policy</a>
                <a href="jkl.html">About Us</a>
                <a href="mno.html">Help</a>
            </div>
            <div class="footer-social">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
            <div class="footer-copyright">
                <p>&copy; 2023 Book Suggestion Site. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
