<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();


        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id']; 

           
            header("Location: Home_new.html");
            exit();
        } else {
            echo "<script>alert('Invalid Password'); window.location.href='loginpage.html';</script>";
        }
    } else {
        echo "<script>alert('User not found'); window.location.href='loginpage.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
