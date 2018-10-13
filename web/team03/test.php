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
$visitedContinents = $_POST['continents'];

$possibleContinents =
    array(
        "NA"=>"North America",
        "SA"=>"South America",
        "EU"=>"Europe",
        "AS"=>"Asia",
        "AUS"=>"Australia",
        "AF"=>"Africa",
        "ANT"=>"Antarctica"
    );
echo "<b>User Name:</b> " . $name . '<br>';
echo "<b>Email: </b><a href='mailto:" . $email . "'>" . $email . "</a><br>";
echo "<b>Major:</b> " . $major . '<br>';
echo "<b>Comments:</b> " . $comments . '<br>';
echo "<b> Visited Continents:</b><br>";


if(empty($visitedContinents) )
{
    echo "You gone nowhere<br>";
}

foreach($visitedContinents as $selected) {
    echo $possibleContinents[$selected] . "<br>";
}

