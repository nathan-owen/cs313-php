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
        $statement = $db->query("
          SELECT tickets.id, title, dateSubmitted, users.name, state, status, approvedBy, dateUpdated FROM tickets
           JOIN users ON users.id = tickets.requestor WHERE status = 'Open'");
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($results) > 0)
        {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
                echo '<th>Title</th><th>Date Submitted</th><th>Requestor</th><th>State</th><th>Status</th><th>Approved By</th><th>Date Updated</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($results as $ticket) {
                echo '<tr>';
                echo "<td><a href='request.php?id=" . $ticket['id'] . "'>" . $ticket['title'] . "</a></td>";
                echo "<td>" . date('d-m-Y',strtotime($ticket['dateSubmitted'])). "</td>";
                echo "<td>" . $ticket['requestor'] . "</td>";
                echo "<td>" . $ticket['state'] . "</td>";
                echo "<td>" . $ticket['status'] . "</td>";
                echo "<td>" . $ticket['approvedBy'] . "</td>";
                echo "<td>" . $ticket['dateUpdated'] . "</td>";
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
    ?>
</main>
</body>
</html>