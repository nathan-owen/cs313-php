<?php
require 'db.php';
$db = connectToDatabase();

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
       $ticketID =  sanitize($_GET['id']);

       $stmt = $db->prepare("SELECT tickets.id, title, description, affectedsystems, rollbackplan, datesubmitted, users.name AS requestor, state, status
                            , (SELECT name FROM users WHERE id = tickets.approvedby) AS approvedby, dateupdated, dateclosed
                          FROM tickets
                          JOIN users ON users.id = tickets.requestor
                          WHERE tickets.id = :id");
       $stmt->bindValue(':id',$ticketID,PDO::PARAM_INT);
       $stmt->execute();
       $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    }
}

function sanitize($data)
{
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
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
        echo '<h3>' . $ticket['title'] . '</h3>';
            echo '<table>';
            echo '<tbody>';
                echo "<tr><td>Title: </td><td>" . $ticket['title'] . "</td></tr>";
                echo "<tr><td>Description: </td><td>" . $ticket['description'] . "</td></tr>";
                echo "<tr><td>Affected Systems: </td><td>" . $ticket['affectedsystems'] . "</td></tr>";
                echo "<tr><td>Rollback Plan: </td><td>" . $ticket['rollbackplan'] . "</td></tr>";
                echo "<tr><td>Date Submitted:</td><td>" . date('m/d/y h:i a', strtotime($ticket['datesubmitted'])) . "</td></tr>";
                echo "<tr><td>Requestor:</td><td>" . $ticket['requestor'] . "</td></tr>";
                echo "<tr><td>State</td><td>" . $ticket['state'] . "</td></tr>";
                echo "<tr><td>Status</td><td>" . $ticket['status'] . "</td></tr>";
                echo "<tr><td>Approved By:</td><td>" . $ticket['approvedby'] . "</td></tr>";
                echo "<tr><td>Date Updated</td><td>" . date('m/d/y h:i a', strtotime($ticket['dateupdated'])) . "</td></tr>";
            echo '</tbody>';
            echo '</table>';

    ?>


    </div>
</main>
</body>
</html>