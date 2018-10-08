<?php
/**
 * Confirmation page
 */
require('items.php');
session_start();
if(isset($_SESSION['cart']))
{
    $cart = $_SESSION['cart'];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = clean_input($_POST["name"]);
    $street = clean_input($_POST["street"]);
    $city = clean_input($_POST["city"]);
    $state = clean_input($_POST["state"]);
    $zip = clean_input($_POST["zip"]);


    session_unset();
    session_destroy();
}
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    <div id="cart">
        <?php
        if(isset($cart) && count($cart) > 0) {
            echo "<h3>Your Purchase is Complete!</h3>";
            echo "<p> Your products will be shipped to the following address:<br>".
                "<b>$name</b><br>".
                "$street<br>".
                "$city,$state,$zip<br>";
            echo "<table><tbody>" .
                "<tr><th>Item</th><th>Price</th></tr>";
            $total = 0.00;

            for($i = 0; $i < count($cart); $i++) {
                echo "<tr><td>" .
                    "<a href='details.php?id=" . $items[$cart[$i]][4] . " ' >" . $items[$cart[$i]][0] . "</a></td><td>" . $items[$cart[$i]][1] . "</td>" .
                    "</tr>";
                $total += $items[$cart[$i]][1];

            }
            echo "<tr><td><b>Total</b></td><td><b>$" . $total . "</b></td></tr>";

            echo " </tbody></table>";
        }
        else {
            echo "<h3>Your cart is empty</h3>";
        }
        ?>
    </div>

</main>
</body>
</body>
</html>