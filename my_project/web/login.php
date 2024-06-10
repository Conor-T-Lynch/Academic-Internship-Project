<?php
//starts the session.
session_start();

//connection to the mimimath database.
$mysqli = new mysqli("mysql", "db_minimath", "db_group5", "database_minimath");

//checks to see if the connection to the database was successful.
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//checks to see if the request method is POST in order to get the form submission.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retriving the username input data from the form.
    $username = $mysqli->real_escape_string($_POST['username']);
    //retriving the password input data from the form.
    $password = $mysqli->real_escape_string($_POST['password']);

    //Fetch user from database using the provided username.
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $mysqli->query($sql);
    //checks to see if exactly one user was found with the provided username exists on the database.
    if ($result->num_rows == 1) {
        //fetch the user data info as an assoc array.
        $user = $result->fetch_assoc();
        //Verify hashed password against the password provided in the form.
        if (password_verify($password, $user['password'])) {
            //set the session variable with the username and redirect to the welcome.php page.
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            //exit the script to prevent further execution.
            exit();
        } else {
            //display error message if username or password in incorrect.
            echo "Invalid username or password";
        }
    } else {
        //display error message if username or password in incorrect.
        echo "Invalid username or password";
    }
}
//close the connection to the database.
$mysqli->close();
?>
