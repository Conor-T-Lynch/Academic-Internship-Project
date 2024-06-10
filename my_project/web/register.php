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
    //retriving the email input data from the form.
    $email = $mysqli->real_escape_string($_POST['email']);
    //retriving the password input data from the form.
    $password = $mysqli->real_escape_string($_POST['password']);
    //retriving the confirm password input data from the form.
    $confirm_password = $mysqli->real_escape_string($_POST['confirm_password']);

    //Checks to see if the passwords match.
    if ($password !== $confirm_password) {
        echo "<div class='error-message'>Passwords do not match.</div>";
    } else {
        //Checks to see if username already exists in the database.
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='error-message'>Username already exists.</div>";
        } else {
            //Checks to see if email already exists in the database.
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                echo "<div class='error-message'>Email already exists.</div>";
            } else {
                //Hash the password before storing it in the database.
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                //Insert new user into the database.
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
                if ($mysqli->query($sql) === TRUE) {
                    echo "<div class='success-message'>Registration successful. <a href='index.html' class='btn btn-custom'>Login here</a></div>";
                } else {
                    //displays an error message if the was an issue with the SQL query.
                    echo "<div class='error-message'>Error: " . $sql . "<br>" . $mysqli->error . "</div>";
                }
            }
        }
    }
}
//close the connection to the database.
$mysqli->close();
?>
