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
    $userID = $_SESSION['userId'];
    $description = sanitize($_POST['description']);
    $affectedSystems = sanitize($_POST['affectedsystems']);
    $rollbackPlan = sanitize($_POST['rollbackplan']);
    $title = sanitize($_POST['title']);


    $stmt = $db->prepare("INSERT INTO tickets (description,affectedsystems,title,rollbackplan,requestor,datesubmitted,dateupdated) VALUES
                                   (:description, :affectedsystems,:title, :rollbackplan, :requestor, NOW(), NOW())");
    $stmt->bindValue(':description',$description,PDO::PARAM_STR);
    $stmt->bindValue(':affectedsystems',$affectedSystems,PDO::PARAM_STR);
    $stmt->bindValue(':rollbackplan',$rollbackPlan,PDO::PARAM_STR);
    $stmt->bindValue(':title',$title,PDO::PARAM_STR);
    $stmt->bindValue(':requestor',$userID,PDO::PARAM_INT);

    $stmt->execute();

    header("Location: dashboard.php");
    die();

}