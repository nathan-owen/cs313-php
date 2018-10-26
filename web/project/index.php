<?php
/*
 * Do some sign in magic
 */
session_start();

if(isset($_SESSION['userId']))
{
    header("Location: dashboard.php");
}
else
{
    header("Location: signIn.php");
}
die();