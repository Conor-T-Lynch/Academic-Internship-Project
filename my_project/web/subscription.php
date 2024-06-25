<?php
//@Reference:“Session in PHP: Creating, Destroying, and Working With Session in PHP,” Simplilearn.com, Apr. 26, 2021. https://www.simplilearn.com/tutorials/php-tutorial/session-in-php#:~:text=To%20set%20session%20variables%2C%20you (accessed Jul. 22, 2024).
//@Reference:“How To Create a Checkout Form with CSS,” www.w3schools.com. https://www.w3schools.com/howto/howto_css_checkout_form.asp (accessed Jul. 22, 2024).
//starts the session.
session_start();
//Checks to see if the 'username' session variable is set.
if (!isset($_SESSION['username'])) {
    //If not set, redirects the user to the login page.
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>Subscription Page</title>
    <!-- Link to Bootstrap CSS for styling and layout -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Link to custom CSS for styling -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <!-- Header title -->
            <h1>Subscribe to Our Website</h1>
            <div class="header-buttons">
                <!-- Button to go back to the welcome page -->
                <a href="welcome.php" class="btn btn-custom" style="margin-left: 10px;">Back to Welcome Page</a>
                <!-- Logout button form -->
                <form action="logout.php" method="post" style="display: inline; margin-left: 30px;">
                    <button type="submit" class="btn btn-custom">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
            <!-- Subscription form with POST method to process_subscription.php -->
            <form id="subscription-form" action="process_subscription.php" method="POST">
                <!-- Form group for choosing a subscription plan -->
                <div class="form-group">
                    <label for="plan">Choose Plan:</label>
                     <!-- Dropdown menu for selecting the subscription plan -->
                    <select id="plan" name="plan" class="form-control" required>
                        <option value="monthly">Monthly - €14.99</option>
                        <option value="yearly">Yearly - €120.00</option>
                    </select>
                </div>
                <!-- Form group for entering credit card number -->
                <div class="form-group">
                    <label for="card-number">Credit Card Number:</label>
                    <input type="text" id="card-number" name="card_number" class="form-control" required>
                </div>
                <!-- Form group for entering card expiry date -->
                <div class="form-group">
                    <label for="expiry-date">Expiry Date:</label>
                    <input type="text" id="expiry-date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                </div>
                <!-- Form group for entering CVC code -->
                <div class="form-group">
                    <label for="cvc">CVC:</label>
                    <input type="text" id="cvc" name="cvc" class="form-control" required>
                </div>
                <!-- Submit button to submit the form -->
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
    <!-- jQuery library for JavaScript functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper.js for additional functionality -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
