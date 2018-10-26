<?php
session_start();
require 'redirect.php';
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
    <div id="requestsLayout">
        <h3>Welcome <?=$_SESSION['usersName'];?></h3>
<h3>Open Change Requests</h3>
        <button id="newRequestButton" onclick="window.location = 'newRequest.php'">Submit New Request</button>
    <?php
        $statement = $db->query("
          SELECT tickets.id, title, datesubmitted, users.name AS requestor, 
            state, status, (SELECT name FROM users WHERE id = tickets.approvedby) AS approvedby, dateupdated 
          FROM tickets
          JOIN users ON users.id = tickets.requestor 
          WHERE status = 'Open'
          ORDER BY datesubmitted DESC");
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($results) > 0)
        {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
                echo '<th>Title</th><th>Date Submitted</th><th>Requestor</th><th>State</th><th>Status</th><th>Approved By</th><th>Last Updated</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($results as $ticket) {
                echo '<tr>';
                echo "<td><a href='request.php?id=" . $ticket['id'] . "'>" . $ticket['title'] . "</a></td>";
                echo "<td>" . date('m/d/y h:i a', strtotime($ticket['datesubmitted'])) . "</td>";
                echo "<td>" . $ticket['requestor'] . "</td>";
                echo "<td>" . $ticket['state'] . "</td>";
                echo "<td>" . $ticket['status'] . "</td>";
                echo "<td>" . $ticket['approvedby'] . "</td>";
                echo "<td>" . date('m/d/y h:i a', strtotime($ticket['dateupdated'])) . "</td>";
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
    ?>
    </div>
</main>
</body>
</html>