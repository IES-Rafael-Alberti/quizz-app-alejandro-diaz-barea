<?php
include 'process.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quizId = 1;
    $db = new mysqli("database", "user_db", "Pestillo123", "quizz_app");
    $formHandler = new Form__Handler($quizId, $db);
    $formHandler->handleSubmission();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quiz</title>
    
    <link rel="stylesheet" href="CSS/quiz.css">
    <script src='main.js'></script>
</head>

<body>
    <button type="button" class="button" onclick="window.location.href='questionManagement.php'">Manage Questions</button>
    <form id="quizForm" method="post" action="<?php echo isset($_GET['success']) ? '#' : "process.php"; ?>">

        <?php
        
        include 'DatabaseManager.php';
        include 'DatabaseCreator.php';
        if (isset($_GET['success'])) {
            $score = count(explode(',', $_GET['success']));
            echo "<p><strong>Your score: $score / 10</strong></p>";
            echo "<form method='get' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input class='button' type='button' value='Try again' onclick='reload()'>";
            echo "</form>";
            exit();
        } else {
            $DbCreator = new DatabaseCreator();
            $db = $DbCreator->getDbConnection();
            $manager = new DatabaseManager();
            echo "<h1>PHP Quiz</h1>";
            echo "<div id=\"timer\">Time remaining: 5:00</div>";
            
            $manager->displayQuestions($db);
            $db->close();
            echo "<input type=\"submit\" value=\"Submit\" >";
        }
        ?>
    </form>
</body>

</html>