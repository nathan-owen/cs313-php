<?php
session_start();
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
else {
    $ticket = null;
}

function getApprovers($db)
{
    $approverStmt = $db->prepare("SELECT id, username, name FROM users WHERE security = 1 ORDER BY name");
    $approverStmt->execute();
    $approvers = $approverStmt->fetchAll(PDO::FETCH_ASSOC);
    return $approvers;
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
        echo '<form method="POST" action="updateRequest.php"><fieldset ' . (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] ? '' : 'disabled') . '>';
            echo '<table>';
            echo '<tbody>';
                echo '<input type="hidden" name="id" value="' . $ticketID . '">';
                echo "<tr><td>Title: </td><td>" . $ticket['title'] . "</td></tr>";
                echo "<tr><td>Description: </td><td><textarea rows='5' cols='40' name='description'>" . $ticket['description'] . "</textarea></td></tr>";
                echo "<tr><td>Affected Systems: </td><td><textarea rows='5' cols='40' name='affectedsystems'>" . $ticket['affectedsystems'] . "</textarea></td></tr>";
                echo "<tr><td>Rollback Plan: </td><td><textarea rows='5' cols='40' name='rollbackplan'>" . $ticket['rollbackplan'] . "</textarea></td></tr>";
                echo "<tr><td>Date Submitted:</td><td>" . date('m/d/y h:i a', strtotime($ticket['datesubmitted'])) . "</td></tr>";
                echo "<tr><td>Requestor:</td><td>" . $ticket['requestor'] . "</td></tr>";
                echo "<tr><td>State</td><td><select name='state'>";
                    $states = array('','Waiting for Review', 'Reviewed', 'Implementing', 'Rejected', 'Implemented');
                    foreach($states as $state)
                    {
                        echo '<option value="' . $state . '" ';
                        if($ticket['state'] == $state)
                        {
                            echo 'selected';
                        }
                        echo '>' . $state . '</option>';
                    }
                echo "</select></td></tr>";
                echo "<tr><td>Status</td><td><select name='status'>";
                    $statuses = array('','Open', 'Closed');
                    foreach($statuses as $status)
                    {
                        echo '<option value="' . $status . '" ';
                        if($ticket['status'] == $status)
                        {
                            echo 'selected';
                        }
                        echo '>' . $status . '</option>';
                    }
                echo "</select></td></tr>";
                echo "<tr><td>Approved By:</td><td><select name='approvedBy'>";
                //Loop through eligible approvers and build the select list.
                echo '<option value="NONE"></option>';
                foreach (getApprovers($db) as $approver)
                {
                    echo '<option value="' . $approver['id'] . '" ';

                    //If it has been approved by this user, mark it selected.
                    if($approver['name'] == $ticket['approvedby'])
                    {
                        echo 'selected';
                    }

                    echo '>' . $approver['name'] . '</option>';
                }
                echo "</select></td></tr>";
                echo "<tr><td>Date Last Updated</td><td>" . date('m/d/y h:i a', strtotime($ticket['dateupdated'])) . "</td></tr>";
            echo '</tbody>';
            echo '</table>';
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
            {
                echo '<input class="button" type="submit" value="Update Request">';
            }
        echo '</fieldset></form>';



    ?>


    </div>
</main>
</body>
</html>