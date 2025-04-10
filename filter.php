<?php
$conn = new mysqli("localhost", "root", "", "user_auth");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'] ?? 'genre';
$title = ucfirst($type);

$query = "SELECT DISTINCT $type FROM books WHERE $type IS NOT NULL AND $type != ''";
$result = $conn->query($query);
$filters = [];
while ($row = $result->fetch_assoc()) {
    $filters[] = $row[$type];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a <?php echo $title; ?></title>
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
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Lora:wght@400;500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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



        body {
            background-color: #eae0d5; /* Light beige */
            font-family: 'Georgia'
            color: #472d1e;
            min-height: 100vh;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200"><rect width="200" height="200" fill="%23eae0d5"/><path d="M0,0 L200,200 M0,200 L200,0" stroke="%23d4c4b1" stroke-width="1"/></svg>');
        }
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        header {
            text-align: center;
            margin-bottom: 3rem;
        }
        h1 {
            font-family: 'Libre Baskerville', serif;
            color: #59341f;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        .subtitle {
            color: #8a7267;
            font-style: italic;
            font-size: 1.1rem;
        }
        /* Bookshelf structure */
        .bookshelf {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        /* Individual shelf */
        .shelf {
            position: relative;
            background-color: #fff;
            border-radius: 5px;
            padding: 25px;
            margin-bottom: 60px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 1;
        }
        /* Shelf wood appearance - bottom */
        .shelf::after {
            content: "";
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 25px;
            background: linear-gradient(90deg, #6b4423, #8c5a33, #6b4423); /* Darker brown gradient */
            box-shadow: 0 8px 10px rgba(0,0,0,0.2);
            border-radius: 0 0 5px 5px;
            z-index: -1;
        }
        /* Shelf wood texture */
        .shelf::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 50px,
                    rgba(107, 68, 35, 0.05) 50px,
                    rgba(107, 68, 35, 0.05) 52px
                );
            pointer-events: none;
            border-radius: 5px;
        }
        /* Shelf supports */
        .shelf-support {
            width: 40px;
            height: 30px;
            background: #6b4423; /* Darker brown */
            position: absolute;
            bottom: -50px;
            z-index: -2;
            border-radius: 3px;
            box-shadow: 0 10px 10px rgba(0,0,0,0.1);
        }
        .shelf-support.left {
            left: 5%;
        }
        .shelf-support.right {
            right: 5%;
        }
        /* Shelf header */
        .shelf-header {
            margin-bottom: 20px;
            position: relative;
        }
        .shelf-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 1.8rem;
            color: #59341f;
            padding-bottom: 8px;
            border-bottom: 2px solid #d4c4b1; /* Light brown border */
        }
        /* Content within shelf */
        .shelf-content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        /* Language cards */
        .language-card {
            flex: 1 1 200px;
            background: linear-gradient(135deg, #f4ebe3, #eae0d5); /* Light beige gradient */
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
        }
        .language-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(255,255,255,0.4) 0%, 
                rgba(255,255,255,0.1) 100%);
            opacity: 0.7;
            z-index: -1;
        }
        .language-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            
        }
        .language-name {
            font-family: 'Libre Baskerville', serif;
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: #472d1e;
        }
        .language-native {
            font-size: 1.2rem;
            color: #8a7267;
            margin-bottom: 15px;
        }
        .language-browse {
            display: inline-block;
            background-color: #8c5a33; /* Rich brown button */
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .language-browse:hover {
            background-color: #6b4423; /* Darker brown on hover */
        }
        /* Color themes for different sections */
        .north-indian-languages {
            background-color: rgba(255, 243, 224, 0.7);
        }
        .south-indian-languages {
            background-color: rgba(232, 244, 248, 0.7);
        }
        .east-indian-languages {
            background-color: rgba(237, 231, 246, 0.7);
        }
        /* Language-specific accent colors */
        .hindi {
            border-left: 4px solid #FF6B6B;
        }
        .marathi {
            border-left: 4px solid #6B5B95;
        }
        .gujarati {
            border-left: 4px solid #88B04B;
        }
        .punjabi {
            border-left: 4px solid #F7CAC9;
        }
        .bengali {
            border-left: 4px solid #92A8D1;
        }
        .telugu {
            border-left: 4px solid #F4A261;
        }
        .tamil {
            border-left: 4px solid #2A9D8F;
        }
        .kannada {
            border-left: 4px solid #E76F51;
        }
        .malayalam {
            border-left: 4px solid #264653;
        }
        /* Small book decorations */
        .shelf-decoration {
            position: absolute;
            right: 15px;
            top: 15px;
            height: 30px;
            display: flex;
        }
        .mini-book {
            width: 10px;
            height: 30px;
            margin-right: 3px;
            transform: rotate(-5deg);
            box-shadow: 2px 2px 3px rgba(0,0,0,0.2);
        }
        .book1 { background-color: #FF6B6B; }
        .book2 { background-color: #6B5B95; }
        .book3 { background-color: #88B04B; height: 25px; }
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
    </style>
</head>
<body>

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
    <div class="page-container">
        <header>
            <h1>Select a <?php echo $title; ?></h1>
            <p class="subtitle">Choose a <?php echo strtolower($title); ?> to explore the books available</p>
        </header>
        <div class="bookshelf">
            <?php
            // Group filters into rows of 4
            $chunks = array_chunk($filters, 3); // Split filters into chunks of 4
            foreach ($chunks as $chunk): ?>
                <div class="shelf north-indian-languages">
                    <div class="shelf-content">
                        <?php foreach ($chunk as $option): ?>
                            <a href="results.php?type=<?php echo urlencode($type); ?>&filter=<?php echo urlencode($option); ?>" class="language-card hindi">
                                <h3 class="language-name"><?php echo htmlspecialchars($option); ?></h3>
                                <p class="language-native">Native Script</p>
                                <p>Explore the rich literary tradition of <?php echo htmlspecialchars($option); ?>, from classics to contemporary works.</p>
                                <span class="language-browse">Browse Books</span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="shelf-support left"></div>
                    <div class="shelf-support right"></div>
                </div>
            <?php endforeach; ?>
        </div>
       
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