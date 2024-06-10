<?php
//starts the session.
session_start();
//Checks to see if the 'username' session variable is set.
if (!isset($_SESSION['username'])) {
    //If not set, redirects the user to the login page.
    header("Location: index.html");
    exit();
}
//checks to see if the request method is POST in order to get the form submission.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //retriving and storing the card_number posted data from the form.
    $card_number = $_POST['card_number'];
    //retriving and storing the expiry_date posted data from the form.
    $expiry_date = $_POST['expiry_date'];
    //retriving and storing the CVV posted data from the form.
    $cvv = $_POST['cvv'];
    //retriving and storing the plan posted data from the form.
    $plan = $_POST['plan'];
    //Assuming the subscription process is successful
    $success = true;
    //Message to display upon successful subscription
    $message = "Thank you, Your subscription to the $plan plan has been processed successfully!.";
}
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
