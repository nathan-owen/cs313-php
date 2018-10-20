<?php
require 'db.php';
$db = connectToDatabase();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Change Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<main>
<h3>Open Change Requests</h3>
    <?php
        foreach ($db->query("SELECT id, title, dateSubmitted, requestor, state, status, approvedBy, dateUpdated FROM tickets WHERE status = 'Open'") as $row) {
            echo $row['title'];
        }
    ?>
</main>
</body>
</html>