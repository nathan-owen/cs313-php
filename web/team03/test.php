<?php
/**
 * Created by PhpStorm.
 * User: natha
 * Date: 10/2/2018
 * Time: 7:25 PM
 */

$name = $_POST['name'];
$email = $_POST['email'];
$comments = $_POST['comments'];
$major = $_POST['major'];

echo "User Name: " . $name . '<br>';
echo "<a href='mailto:" . $email . "'>" . $email . "</a><br>";
echo "Major: " . $major . '<br>';
echo "Comments: " . $comments . '<br>';