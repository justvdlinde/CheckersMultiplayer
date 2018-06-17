<style>
<?php include 'style.css'; ?>
</style>

<?php
session_start();
echo 'Welcome '.$_SESSION['fullname']. '<br><br>';
echo '<a href="UserOverview.php">User Overview</a> <br>';
echo '<a href="ScoreOverview.php">Scores Overview</a> <br>';
echo '<a href="editaccount.php">Edit Account</a> <br>';
echo '<a href="addscore.php">Add Score</a> <br>';
echo '<a href="gameinfo.php">Game Info / Highscores</a> <br>';
echo '<a href="index.php?action=logout">Logout</a>';
?>


