<?php
//@Reference:W3Schools, “PHP 5 Sessions,” W3schools.com, 2019. https://www.w3schools.com/php/php_sessions.asp (accessed Jul. 22, 2024).
//@Reference:“Session in PHP: Creating, Destroying, and Working With Session in PHP,” Simplilearn.com, Apr. 26, 2021. https://www.simplilearn.com/tutorials/php-tutorial/session-in-php#:~:text=To%20set%20session%20variables%2C%20you (accessed Jul. 22, 2024).
//@Reference:“PHP and JSON,” www.w3schools.com. https://www.w3schools.com/php/php_json.asp (accessed Jul. 22, 2024).
//@Reference:“Get data from JSON file with PHP,” Stack Overflow. https://stackoverflow.com/questions/19758954/get-data-from-json-file-with-php (accessed Jul. 22, 2024).
//starts the users current session.
session_start();

//if the user is not logged in, will redirect the user to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Check if the user is subscribed.
if (!isset($_SESSION['subscribed']) || $_SESSION['subscribed'] != 1) { // Check if subscribed is 1 (true)
    // If not subscribed, redirect the user to the subscription page.
    header("Location: subscription.php");
    exit();
}

//loads the questions from the json file from class1
$jsonData = file_get_contents('questions.json');
$questions = json_decode($jsonData, true)['class1'];

//initialize the session variables.
if (!isset($_SESSION['current_question'])) {
    //current_question variable.
    $_SESSION['current_question'] = 0;
    //correct_answer variable.
    $_SESSION['correct_answers'] = 0;
    //total_questions variable.
    $_SESSION['total_questions'] = count($questions);
    //all_correct variable.
    $_SESSION['all_correct'] = true;
    //score variable
    $_SESSION['score'] = 0;
}

//initialize feedback message.
$feedback = "";

//post method to process the form submission from the user.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //current_question index.
    $index = $_SESSION['current_question'];
    //get users answer from the form.
    $userAnswer = $_POST['answer'];
    //get the correct answer from current question.
    $correctAnswer = $questions[$index]['answer'];

    //check if users answer is correct.
    if ($userAnswer == $correctAnswer) {
        $feedback = "Correct!";
        $_SESSION['correct_answers'] += 1;
        //increase users score by 5
        $_SESSION['score'] += 5;
    } else {
        $feedback = "Incorrect. The correct answer is " . $correctAnswer . ".";
        //sets the flag as false if the user gets any questions wrong.
        $_SESSION['all_correct'] = false;
    }

    //moves on to the next question on the json file from class1.
    $_SESSION['current_question']++;

    //checks if all questions have been answered.
    if ($_SESSION['current_question'] >= $_SESSION['total_questions']) {
        //sets final message, depends on if all questions were correct or not.
        if ($_SESSION['all_correct']) {
            $final_message = "Congratulations! All your answers are correct. Your total score is " . $_SESSION['score'] . " points.";
        } else {
            $final_message = "Well done, but not all answers were correct. Your total score is " . $_SESSION['score'] . " points.";
        }

        //resets the session variables for a new round of questions.
        $_SESSION['current_question'] = 0;
        $_SESSION['correct_answers'] = 0;
        $_SESSION['all_correct'] = true;
        $_SESSION['score'] = 0;
    }
}

//get the current question to display.
$currentQuestionIndex = $_SESSION['current_question'];
$currentQuestion = $questions[$currentQuestionIndex]['question'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="css/styles.css">
    <title>1st Class Questions</title>
</head>
<body>
    <header>
        <div class="container">
            <!-- Displays a welcome message with the user's username -->
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <div class="header-buttons">
                <!-- Button to go back to the subscription page -->
                <a href="subscription.php" class="btn btn-custom" style="margin-left: 10px;">Subscribe</a>
                <!-- Logout button form -->
                <form action="logout.php" method="post" style="margin-left: 30px;">
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
            <h2>1st Class Mathematical Questions</h2>
            <div class="score">
                <!-- Displays the user's current score -->
                <p>Current Score: <?php echo $_SESSION['score']; ?> points</p>
            </div>
            <!-- Displays the final message, depending on if all questions have been answered correctly or not -->
            <?php if (isset($final_message)): ?>
                <div class="alert alert-info"><?php echo $final_message; ?></div>
            <?php else: ?>
                <!-- Displays feedback message after each answer, if it was correct or incorrect -->
                <?php if ($feedback): ?>
                    <div class="alert alert-info"><?php echo $feedback; ?></div>
                <?php endif; ?>
                <!-- Form to submit the answer for the current question -->
                <form method="post" action="class1.php">
                    <div class="form-group">
                        <label for="answer"><?php echo $currentQuestion; ?></label>
                        <input type="text" name="answer" id="answer" class="form-control smaller-input" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Submit Answer</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <!-- Link to Bootstrap js for functionality -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
