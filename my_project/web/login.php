<?php
//@Reference:W3Schools, “PHP 5 Sessions,” W3schools.com, 2019. https://www.w3schools.com/php/php_sessions.asp (accessed Jul. 22, 2024).
//@Reference:“Session in PHP: Creating, Destroying, and Working With Session in PHP,” Simplilearn.com, Apr. 26, 2021. https://www.simplilearn.com/tutorials/php-tutorial/session-in-php#:~:text=To%20set%20session%20variables%2C%20you (accessed Jul. 22, 2024).
//@Reference:“How To Create A OOP PHP Login System For Beginners | OOP PHP & PDO | OOP PHP Tutorial,” www.youtube.com. https://www.youtube.com/watch?v=BaEm2Qv14oU&ab_channel=DaniKrossing (accessed Jul. 22, 2024).
//@Reference:“Simple signup and login system with PHP and Mysql database | Full Tutorial | How to & source code,” www.youtube.com. https://www.youtube.com/watch?v=WYufSGgaCZ8&ab_channel=QuickProgramming (accessed Jul. 22, 2024).
//@Reference:D. Adams, “Secure Login System with PHP and MySQL,” CodeShack, Mar. 15, 2018. https://codeshack.io/secure-login-system-php-mysql/ (accessed Jul. 22, 2024).
//@Reference:Andropov Ajuatah Ajebua, “Building a Secure Login and Registration System with HTML, CSS, JavaScript, PHP, and MySQL,” Medium, Apr. 12, 2024. https://medium.com/@ajuatahcodingarena/building-a-secure-login-and-registration-system-with-html-css-javascript-php-and-mysql-591f839ee8f3 (accessed Jul. 22, 2024).
//Start the session.
session_start();

//Connection to the minimath database.
$mysqli = new mysqli("mysql", "db_minimath", "db_group5", "database_minimath");

//Check if the connection to the database was successful.
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//checks to see if the request method is POST in order to get the form submission.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retriving the username input data from the form.
    $username = $mysqli->real_escape_string($_POST['username']);
    //retriving the password input data from the form.
    $password = $mysqli->real_escape_string($_POST['password']);

    //Fetch user from the database using the provided username.
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $mysqli->query($sql);

    //Check if exactly one user was found with the provided username in the database.
    if ($result->num_rows == 1) {
        //Fetch the user data as an associative array.
        $user = $result->fetch_assoc();

        //Verify hashed password against the password provided in the form.
        if (password_verify($password, $user['password'])) {
            //Set the session variables with the username and subscription status.
            $_SESSION['username'] = $username;
            $_SESSION['subscribed'] = $user['subscribed'];

            //Redirect to the welcome.php page.
            header("Location: welcome.php");
            //Exit the script to prevent further execution.
            exit();
        } else {
            //Display an error message if the username or password is incorrect.
            echo "Invalid username or password";
        }
    } else {
        //Display an error message if the username or password is incorrect.
        echo "Invalid username or password";
    }
}

//Close the connection to the database.
$mysqli->close();
?>
