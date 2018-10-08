<?php
/**
 * Item DetailsPage
 */
require('items.php');
session_start();
if(isset($_SESSION['cart']))
{
    $cart = $_SESSION['cart'];
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
    <div id="cart">
        <?php
            if(isset($cart) && count($cart) > 0) {
                echo "<h3>Your Cart</h3>";
                echo "<table><tbody>" .
                    "<tr><th>Item</th><th>Price</th><th>Action</th></tr>";

                $total = 0.00;
                for($i = 0; $i < count($cart); $i++) {
                  echo "<tr><td>" .
                        "<a href='details.php?id=" . $items[$cart[$i]][4] . " ' >" . $items[$cart[$i]][0] . "</a></td><td>$" . $items[$cart[$i]][1] . "</td><td><a href='cart.php?pos=". $i ."'>Remove from Cart</a></td>" .
                       "</tr>";
                  $total += $items[$cart[$i]][1];
                }
                echo "<tr><td><b>Total</b></td><td><b>$" . $total . "</b></td></tr>";

                echo " </tbody></table>";

                echo "<button class='button' onclick=\"window.location.replace('checkout.php')\">Checkout</button>";
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