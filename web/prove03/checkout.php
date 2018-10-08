<?php
/**
 * Checkout Page
 */
require('items.php');
session_start();
if(isset($_SESSION['cart']))
{
    $cart = $_SESSION['cart'];
    if(count($cart) <= 0)
    {
        header("Location: index.php");
        die();
    }
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET["pos"])) {
        $index = htmlspecialchars($_GET["pos"]);
        $index = (int)$index;
        if (isset($cart)) {
            unset($cart[$index]);
            $cart = array_values($cart);
        }

        $_SESSION['cart'] = $cart;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Safari.com</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<main>
<div>
    <h3>Checkout</h3>
    <form action="confirmation.php" method="post">
        Name: <input type="text" name="name"><br>
        Street: <input type="text" name="street"><br>
        City: <input type="text" name="city"><br>
        State: <input type="text" name="state"><br>
        Zip: <input type="number" name="zip"><br>
        <input class="button" type="submit" value="Checkout">
    </form>
</div>

</main>
</body>
</body>
</html>