<?php
/**
 * Created by PhpStorm.
 * User: natha
 * Date: 10/20/2018
 * Time: 5:41 PM
 */

date_default_timezone_set('UTC');
function connectToDatabase()
{
    try {

        $dbUrl = getenv('DATABASE_URL');

        $dbOpts = parse_url($dbUrl);

        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"], '/');

        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

       // $db = new PDO("pgsql:host=localhost;dbname=postgres","postgres","1-1=Postgres");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
    return $db;
}