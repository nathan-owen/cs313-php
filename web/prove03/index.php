<?php
/**
 * Browse Page/Home Page
 */

require('items.php');
session_start();

/*
foreach ($items as $item) {
    echo "Name: " . $item[0] ."<br>".
        "Price: " . $item[1] ."<br>".
        "Description: " .$item[2]. "<br>".
        "<img src='images/" . $item[3][0] . "' width='50px'/><img src='images/" . $item[3][1] . "' width='50px'/><br><br>";

}
*/
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
    <div class="itemsLayout">
        <?php
        foreach ($items as $item) {
            echo "<a class='item' title='" .$item[0] . "' href='details.php?id=" . $item[4] ."'>" .
                    "<div>
                        <img class='itemThumb' src='images/" . $item[3][0] . "'/><br>
                        <p class='itemName'>$item[0]</p>
                        <p class='itemPrice'>\$$item[1]</p>
                    </div>
                 </a>";
        }
        ?>
    </div>

</main>
</body>
</html>