<?php
session_start();
require 'redirect.php';

require 'db.php';
$db = connectToDatabase();

function sanitize($data)
{
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Get POST Data
    $ticketID = sanitize($_POST['id']);
    $description = sanitize($_POST['description']);
    $affectedSystems = sanitize($_POST['affectedsystems']);
    $rollbackPlan = sanitize($_POST['rollbackplan']);
    $state = sanitize($_POST['state']);
    $status = sanitize($_POST['status']);


    if(isset($_SESSION['isAdmin']) &&  $_SESSION['isAdmin'])
    {    $approvedBy = sanitize($_POST['approvedBy']);

        $stmt = $db->prepare("UPDATE tickets SET approvedby=:approvedby WHERE id=:id");
        $stmt->bindValue(':approvedby',$approvedBy,PDO::PARAM_INT);
        $stmt->bindValue(':id',$ticketID,PDO::PARAM_INT);
        $stmt->execute();
    }


    $findTicket = $db->prepare("SELECT * FROM tickets WHERE id = :ticketID");
    $findTicket->bindValue(":ticketID",$ticketID,PDO::PARAM_INT);
    $findTicket->execute();
    $ticket = $findTicket->fetch(PDO::FETCH_ASSOC);

    if((isset($_SESSION['usersName']) && $_SESSION['usersName'] == $ticket['requestor']) || (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) ) {

        $stmt = $db->prepare("UPDATE tickets SET description=:description, affectedsystems=:affectedsystems, rollbackplan=:rollbackplan,
                                    state=:state, status=:status, dateupdated = NOW()
                                    WHERE id=:id");

        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':affectedsystems', $affectedSystems, PDO::PARAM_STR);
        $stmt->bindValue(':rollbackplan', $rollbackPlan, PDO::PARAM_STR);
        $stmt->bindValue(':state', $state, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $ticketID, PDO::PARAM_INT);

        $stmt->execute();
    }
    header("Location: dashboard.php");
    die();

}