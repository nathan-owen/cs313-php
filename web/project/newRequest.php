<?php
session_start();
require 'db.php';


?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?=$ticket['title'];?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<main>
    <div id="requestsLayout">
        <button class="button" onclick="window.history.back();">Back</button>
    <?php
        echo '<h3>New Change Request</h3>';
        echo '<form method="POST" action="insertRequest.php">';
            echo '<table>';
            echo '<tbody>';
                echo "<tr><td>Title: </td><td><input type='text' name='title'></td></tr>";
                echo "<tr><td>Description: </td><td><textarea rows='5' cols='40' name='description'></textarea></td></tr>";
                echo "<tr><td>Affected Systems: </td><td><textarea rows='5' cols='40' name='affectedsystems'></textarea></td></tr>";
                echo "<tr><td>Rollback Plan: </td><td><textarea rows='5' cols='40' name='rollbackplan'></textarea></td></tr>";
                echo "<tr><td>Requestor:</td><td>" . $_SESSION['usersName'] . "</td></tr>";
            echo '</tbody>';
            echo '</table>';
            echo '<input class="button" type="submit" value="Submit Request">';
        echo '</form>';



    ?>


    </div>
</main>
</body>
</html>