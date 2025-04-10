
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
       
        echo "<script>alert('Registration successful! Redirecting to login...'); window.location.href='loginpage.html';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='register.html';</script>";
    }

    $conn->close();
}
?>
