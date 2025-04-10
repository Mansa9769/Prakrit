<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = $_POST['book_id'] ?? 0;

// Check if already added
$check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = $user_id AND book_id = $book_id");
if (mysqli_num_rows($check) == 0) {
    $stmt = $conn->prepare("INSERT INTO favorites (user_id, book_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $book_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: book.php?book_id=" . $book_id);
exit();
?>
