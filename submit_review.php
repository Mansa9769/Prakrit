<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_POST['book_id'], $_POST['rating'], $_POST['review_text'])) {
    die("Missing form data.");
}

$user_id = $_SESSION['user_id'];
$book_id = (int) $_POST['book_id'];
$rating = (int) $_POST['rating'];
$review_text = mysqli_real_escape_string($conn, trim($_POST['review_text']));


if ($rating < 1 || $rating > 5) {
    die("Invalid rating value.");
}


$stmt = $conn->prepare("INSERT INTO reviews (user_id, book_id, rating, review_text) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $user_id, $book_id, $rating, $review_text);

if ($stmt->execute()) {
    header("Location: book.php?book_id=$book_id");
    exit();
} else {
    echo "Error submitting review: " . $stmt->error;
}
?>
