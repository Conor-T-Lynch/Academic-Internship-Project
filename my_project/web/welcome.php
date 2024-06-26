<?php
//@Reference:“Session in PHP: Creating, Destroying, and Working With Session in PHP,” Simplilearn.com, Apr. 26, 2021. https://www.simplilearn.com/tutorials/php-tutorial/session-in-php#:~:text=To%20set%20session%20variables%2C%20you (accessed Jul. 22, 2024).
//starts the users current session.
session_start();
//if the user is not logged in, will redirect the user to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
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
    <link rel="stylesheet" href="css/welcome.css">
    <title>Welcome</title>
</head>
<body>
    <header>
    <!-- Logo -->
    <img src="Logo.png" alt="Mini Math" width="80" height="80"> 
                
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        </div>

        <div class="header-buttons">
                <!-- Logout button form -->
                <form action="logout.php" method="post">
                    <button type="submit" class="btn btn-custom">Logout</button>
                </form>
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
             <!-- Welcome message to the user -->
            <h2>Welcome to the MiniMath Educational Platform</h2>
             <!-- informing the user on how to navigate the class links -->
            <p>Select a class from the sidebar to view the questions.</p>
            <p><a href="subscription.php" class="btn btn-primary">Subscribe Now</a></p>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
