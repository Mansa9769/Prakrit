<?php
include 'db_connect.php';

$query = "SELECT * FROM books ORDER BY title ASC";
$result = mysqli_query($conn, $query);

$books = [];
while ($row = mysqli_fetch_assoc($result)) {
    $books[] = $row;
}

include 'all_books.html';
?>
