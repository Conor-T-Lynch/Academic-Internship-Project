<?php
session_start();

// Database connection
$mysqli = new mysqli("mysql", "db_minimath", "db_group5", "database_minimath");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // Fetch user from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
}

$mysqli->close();
?>
