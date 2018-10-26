<?php
session_start();
require 'db.php';
$db = connectToDatabase();

if($_SERVER["REQUEST_METHOD"] == 'POST')
{
    if(isset($_POST['submit'])) {
        $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->bindValue(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password,$user['password']))
        {
            session_regenerate_id(true);
            $_SESSION['username'] = $user['username'];
            $_SESSION['userId'] = $user['id'];
            $_SESSION['usersName'] = $user['name'];
            $_SESSION['security'] = $user['security'];
            $_SESSION['isAdmin'] = ($user['security'] == 1 ? true : false);
            header("Location: dashboard.php");
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Change Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
    <ul>
        <li class="logo">Change Management</li>
    </ul>
</nav>
<main>
    <div id="signIn">
<h3>Sign In</h3>
    <form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Username</label><input id="username" type="text" name="username">
        <label for="password">Password</label><input id="password" type="password" name="password">
        <input class="button" type="submit" name="submit" value="Sign In">
    </form>
    </div>
</main>
</body>
</html>