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

echo "User Name: " . $name . '\n';
echo "<a href='mailto:" . $email . "'>" . $email . "</a>\n";
echo "Major: " . $major . '\n';
echo "Comments: " . $comments . '\n';