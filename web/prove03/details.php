<?php
/**
 * Item DetailsPage
 */
require('items.php');
session_start();
$id = htmlspecialchars($_GET['id']);
$item = $items[$id];
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //The Add to Cart Button was pressed. Lets add the item to the cart.
    $addID = htmlspecialchars($_POST["productID"]);
    $_SESSION['cart'][] = (int)$addID;
    $message = "Item added to cart!";
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
    <h3 id="message"><?=$message?></h3>

    <div id="productDetails">
        <div id="detailImage">
            <img width="100%" src="images/<?=$item[3][0]?>"/>
        </div>
        <div id="detailInfo">
            <p id="itemDetailName"><?=$item[0]?></p>
            <p id="itemDetailPrice">Price: $<?=$item[1]?></p>
            <p id="itemDescription">Description: <?=$item[2]?></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id";?>">
            <input type="hidden" name="productID" value="<?=$id?>">
            <input type="submit" class="button" value="Add to Cart">
        </form>
        </div>
    </div>
</main>
</body>
</html>