<?php
//@Reference:“Session in PHP: Creating, Destroying, and Working With Session in PHP,” Simplilearn.com, Apr. 26, 2021. https://www.simplilearn.com/tutorials/php-tutorial/session-in-php#:~:text=To%20set%20session%20variables%2C%20you (accessed Jul. 22, 2024).
//@Reference:“How To Create A OOP PHP Login System For Beginners | OOP PHP & PDO | OOP PHP Tutorial,” www.youtube.com. https://www.youtube.com/watch?v=BaEm2Qv14oU&ab_channel=DaniKrossing (accessed Jul. 22, 2024).
//@Reference:D. Adams, “Secure Login System with PHP and MySQL,” CodeShack, Mar. 15, 2018. https://codeshack.io/secure-login-system-php-mysql/ (accessed Jul. 22, 2024).
//@Reference:“Processing a subscription form with POST method?,” WordPress Development Stack Exchange. https://wordpress.stackexchange.com/questions/196879/processing-a-subscription-form-with-post-method (accessed Jul. 22, 2024).
//Start the session.
session_start();

//Check if the 'username' session variable is set.
if (!isset($_SESSION['username'])) {
    //If not set, redirects the user to the login page.
    header("Location: index.html");
    exit();
}

//Initialize $success and $message variables.
$success = false;
$message = "";

//Database connection settings.
$hostname = "mysql";
//username for our mysql database.
$username = "db_minimath";
//password for our mysql database.
$password = "db_group5";
//Database name
$database = "database_minimath";

//Establish a connection to the database.
$mysqli = new mysqli($hostname, $username, $password, $database);

//Check if the connection was successful.
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//Check if the request method is POST to process the form submission.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //retriving and storing the card_number posted data from the form.
    $card_number = $mysqli->real_escape_string($_POST['card_number']);
    //retriving and storing the expiry_date posted data from the form.
    $expiry_date = $mysqli->real_escape_string($_POST['expiry_date']);
    //retriving and storing the CVV posted data from the form.
    $cvv = $mysqli->real_escape_string($_POST['cvv']);
    //retriving and storing the plan posted data from the form.
    $plan = $mysqli->real_escape_string($_POST['plan']);
    //retriving the username of the current user of the session.
    $username = $_SESSION['username'];

    //Update the subscription status in the database.
    $stmt = $mysqli->prepare("UPDATE users SET subscribed = TRUE WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        //Subscription process successful.
        $success = true;
        $message = "Thank you, your subscription to the $plan plan has been processed successfully!";
    } else {
        //Subscription process failed.
        $message = "There was an error processing your subscription. Please try again.";
    }

    //Close the statement.
    $stmt->close();
}

//Close the database connection.
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS for styling and layout -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Link to custom CSS for styling -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Page title -->
    <title>Subscription Process</title>
</head>
<body>
    <header>
        <div class="container">
            <!-- Header title -->
            <h1>Subscription Status</h1>
            <div class="header-buttons">
                <!-- Logout form -->
                <form action="logout.php" method="post">
                    <button type="submit" class="btn btn-custom">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="wrapper">
        <div class="sidebar">
            <!-- Sidebar title -->
            <h2>Classes</h2>
            <!-- Navigation links for different classes -->
            <a href="class1.php">1st Class</a>
            <a href="class2.php">2nd Class</a>
            <a href="class3.php">3rd Class</a>
            <a href="class4.php">4th Class</a>
            <a href="class5.php">5th Class</a>
            <a href="class6.php">6th Class</a>
        </div>
        <div class="content">
            <!-- subscription status header -->
            <h2>Subscription Status</h2>
            <!-- Checks if the subscription process was successful -->
            <?php if (isset($success) && $success): ?>
                <div class="alert alert-success">
                    <!-- Displays the success message -->
                    <?php echo htmlspecialchars($message); ?>
                </div>
                <!-- JavaScript to log out and redirect after delay -->
                <script>
                    setTimeout(function() {
                        //Redirect to index.html.
                        window.location.href = 'index.html';
                        //3000 milliseconds = 3 seconds
                    }, 3000);
                </script>
            <?php else: ?>
                <!-- Displays an error message if the subscription process failed -->
                <div class="alert alert-danger">
                    There was an error processing your subscription. Please try again.
                </div>
            <?php endif; ?>
            <!-- Button to go back to the welcome page -->
            <a href="welcome.php" class="btn btn-custom">Back to Welcome Page</a>
        </div>
    </div>
    <!-- jQuery library for JavaScript functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper.js for additional functionality -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
