<?php
session_start();
include 'db_connect.php';

$book_id = $_GET['book_id'] ?? 1;

$query = "SELECT * FROM books WHERE id = $book_id";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);




// Get reviews
$reviews_html = "";
$review_query = "SELECT r.rating, r.review_text, r.timestamp, u.username
                 FROM reviews r JOIN users u ON r.user_id = u.id
                 WHERE r.book_id = $book_id ORDER BY r.timestamp DESC";
$review_result = mysqli_query($conn, $review_query);



while ($r = mysqli_fetch_assoc($review_result)) {
    $reviews_html .= "<div class='review'>
        <p><strong>{$r['username']}</strong> rated it <span class='rating'>{$r['rating']}/5</span></p>
        <p>{$r['review_text']}</p>
        <small>{$r['timestamp']}</small>
    </div>";
}

// Review form (if logged in)
$review_form = "";
if (isset($_SESSION['user_id'])) {
    $review_form = "
    <form action='submit_review.php' method='POST' class='review-form'>
        <input type='hidden' name='book_id' value='{$book_id}'>
        <label for='rating'>Rating:</label>
        <select name='rating' id='rating' required>
            <option value='' disabled selected>Select rating</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
        </select>
        
        <label for='review_text'>Review:</label>
        <textarea name='review_text' id='review_text' rows='4' class='text' placeholder='Write your review here...' required></textarea>
        
        <button type='submit'>Submit Review</button>
    </form>";
} else {
    $review_form = "<p><em>You must be logged in to submit a review.</em></p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($book['title']) ?> | Prakrit</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=YOUR_KEY_HERE"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="jquery-3.7.1.js"></script>
    <script>
$(document).ready(function() {
    const bookTitle = "<?= htmlspecialchars($book['title']) ?>";

    $.get('check_availability.php?title=' + encodeURIComponent(bookTitle), function(data) {
        if (data.length === 0) {
            $('#availability').html("<p>No listings found.</p>");
        } else {
            let html = "<h3>Where to find this book:</h3><ul>";
            data.slice(0, 3).forEach(book => {
                html += `<li><a href="${book.link}" target="_blank">${book.title} by ${book.authors}</a></li>`;
            });
            html += "</ul>";
            $('#availability').html(html);
        }
    });
});
</script>
</script>
    <style>
           * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
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
    background: linear-gradient(135deg, #3e2217, #8a5a3c); 
    padding: 18px 50px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}


nav img {
    width: 85px;
    height: auto;
    transition: transform 0.3s ease-in-out;
}

nav img:hover {
    transform: scale(1.08);
}


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
            background: linear-gradient(135deg, #f4e6d2, #e0c9a6);
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
        }

        .book-container {
            max-width: 900px;
            background-color: #fffaf3;
            margin: 40px auto;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }

      
        .book-container img {
            width: 100%; 
            height: auto; 
            max-height: 400px; 
            object-fit: cover; 
            border-radius: 12px;
            display: block;
            margin: 0 auto 25px auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            text-align: center;
            color: #3e2217;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 22px;
            margin-top: 40px;
            color: #4e2d1b;
            border-left: 6px solid #8a5a3c;
            padding-left: 12px;
        }

        p, small {
            font-size: 17px;
            color: #5c3b2e;
            line-height: 1.6;
            margin: 8px 0;
        }

     
        .review-form {
            margin-top: 20px;
            background: #f9efe3;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .review-form label {
            display: block;
            margin-top: 10px;
            margin-bottom: 6px;
            font-weight: bold;
            color: #3e2217;
        }

        .review-form select,
        .review-form textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-family: 'Georgia';
            border: 1px solid #c1a782;
            border-radius: 6px;
            background-color: #fff;
            resize: none;
        }

       


        .review-form button {
            margin-top: 15px;
            padding: 10px 18px;
            background-color: #8a5a3c;
            color: #fffaf3;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .review-form button:hover {
            background-color: #6f402a;
            transform: translateY(-2px);
        }


        .review {
            background-color: #fef8f1;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #8a5a3c;
            border-radius: 10px;
        }

        .rating {
            color: #b3562b;
        }

        hr {
            margin: 40px 0;
            border: none;
            height: 1px;
            background-color: #e4d0b8;
        }

        .book-container img {
    width: 100%; 
    height: auto; 
    max-width: 380px; 
    max-height: 400px; 
    object-fit: contain; 
    border-radius: 12px;
    display: block;
    margin: 0 auto 25px auto; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
.review-form {
    margin-top: 20px;
    background: #f9efe3;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.review-form label {
    display: block;
    margin-top: 10px;
    margin-bottom: 6px;
    font-weight: bold;
    color: #3e2217;
}

.review-form select,
.review-form textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    font-family: 'Georgia';
    border: 1px solid #c1a782;
    border-radius: 6px;
    background-color: #fff;
    resize: none;
}

.review-form button,.summary {
    margin-top: 15px;
    padding: 10px 18px;
    background-color: #8a5a3c;
    color: #fffaf3;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s;
}



.review {
    background-color: #fef8f1;
    padding: 15px;
    margin: 15px 0;
    border-left: 4px solid #8a5a3c;
    border-radius: 10px;
}

.rating {
    color: #b3562b;
}

.review p {
    margin: 5px 0;
    font-size: 16px;
    line-height: 1.5;
}

.review small {
    display: block;
    margin-top: 5px;
    font-size: 14px;
    color: #5c3b2e;
}


.review-form {
    margin-top: 20px;
    background: #f9efe3;
    padding: 20px; 
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 15px; 
}


.review-form label {
    font-weight: bold;
    color: #3e2217;
    margin: 0; 
}


.review-form select,
.review-form textarea {
    width: calc(100% - 20px); 
    padding: 10px;
    font-size: 16px;
    font-family: 'Georgia', serif;
    border: 1px solid #c1a782;
    border-radius: 6px;
    background-color: #fff;
    resize: none; 
    box-sizing: border-box; 
}


.review-form button {
    align-self: flex-start; 
    padding: 10px 18px;
    background-color: #8a5a3c;
    color: #fffaf3;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s;
}

.review-form button:hover {
    background-color: #6f402a;
    transform: translateY(-2px);
}


.fav{
    background-color: #8a5a3c; 
    color: white; 
    border: none; 
    padding: 10px 18px; 
    border-radius: 8px; 
    cursor: pointer;
    font-size:16px;
    font-family:"Georgia"
}
.fav:hover{
transform:scale(1.2,1.2)
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

.summary:hover{
transform:scale(1.2,1.2)
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
            <a href="favorites.php" target="content" >Favourites</a>
            <a href="UserProfile.html" target="content"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>

           
        </span>
    </nav>
<div class="book-container">
    <
    <img src="<?= htmlspecialchars($book['cover_url']) ?>" alt="Cover">
    

    <h2><?= htmlspecialchars($book['title']) ?></h2>
    <?php if (isset($_SESSION['user_id'])): ?>
    <form action="add_to_favorites.php" method="POST" style="margin-bottom: 20px;">
        <input type="hidden" name="book_id" value="<?= $book_id ?>">
        <button type="submit"  class="fav">
        Add to Favorites    <i class="fa fa-heart"></i> 
        </button>
    </form>
<?php endif; ?>

    <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
    <p><strong>Language:</strong> <?= htmlspecialchars($book['language']) ?></p>
    <p><strong>Genre:</strong> <?= htmlspecialchars($book['genre']) ?></p>
    <p><strong>Publisher:</strong> <?= htmlspecialchars($book['publisher']) ?></p>
    <p><strong>Year:</strong> <?= htmlspecialchars($book['year_published']) ?></p>
    <p id="book-desc"><?= htmlspecialchars($book['description']) ?></p>
<button onclick="speakDescription()" class="summary">🔊 Hear Summary</button>


<div id="availability" style="margin-top: 20px; font-family: Georgia; background: #f5efe6; padding: 15px; border-radius: 10px;">
    <p>Checking availability...</p>
</div>





    <hr>
    <h3>Submit Your Review</h3>
    <?= $review_form ?>

    <hr>
    <h3>User Reviews</h3>
    <?= $reviews_html ?>
</div>


<script>
function speakDescription() {
    const text = document.getElementById("book-desc").innerText;
    responsiveVoice.speak(text, "Hindi Female"); 
}
</script>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=lWshVb1o"></script>
</body>

</html>