<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/product-details.css">
    <title>product</title> <!-- Use string literal here-->
    <?php
        session_start();
        require('../controllers/db_model.php');

        $stmt = $conn->prepare("SELECT * FROM products WHERE pID = ?");
        $stmt->execute([$_GET['id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        //ADD TO CART
        if (isset($_POST['productID'])) {
            $productID = filter_input(INPUT_POST, 'productID', FILTER_SANITIZE_STRING);

            // GET TRANSACTION ID
            $stmt = $conn->prepare("SELECT tID FROM transactions WHERE uID = ? AND tStatus= 1");
            $stmt->execute([$_SESSION['userID']]);
            $transactionID = $stmt->fetchColumn();

            // if transaction exists
            if ($transactionID != null) {
                // if order of product exists, increment the quantity
                $stmt = $conn->prepare("SELECT oID FROM orders WHERE tID = ? AND pID = ?");
                $stmt->execute([$transactionID, $productID]);
                $orderID = $stmt->fetchColumn();
                if ($orderID != null) {
                    $stmt = $conn->prepare("UPDATE orders SET oQty = oQty + ? WHERE oID = ?");
                    $stmt->execute([$_POST['productQuantity'], $orderID]);
                } else {
                    // add this product to the db
                    $stmt = $conn->prepare("INSERT INTO orders (tID, pID, oQty) VALUES (?, ?, ?)");
                    $stmt->execute([$transactionID, $productID, $_POST['productQuantity']]);
                }
            } else {
                // if no transaction exists, create one
                $stmt = $conn->prepare("INSERT INTO transactions (uID, tType, tStatus) VALUES (?, 2, 1)");
                $stmt->execute([$_SESSION['userID']]);
                $transactionID = $conn->lastInsertId();
                $stmt = $conn->prepare("INSERT INTO orders (tID, pID, oQty) VALUES (?, ?, ?)");
                $stmt->execute([$transactionID, $productID, $_POST['productQuantity']]);
            }
        }
    ?>
</head>

<body>
<div id="header-placeholder"></div>
<section id="product-background">
    <div class="food-container">
        <div class="image-container-product">
            <img src="assets/cake-with-transparent-background-high-quality-ultra-hd-free-photo.jpg" alt="food1" class="food-image">
        </div>
        <div class="text-container">
            <h1>
                <?php echo $product['pName'];?>
            </h1>
            <p><?php echo $product['pDesc'];?></p>
            <form action="product-details.php?id=<?php echo $product['pID'] ?>" method="post">
                <label for="productQuantity">Quantity:</label>
                <input type="number" name="productQuantity" id="productQuantity" min="1" value="1">

                <button type="submit" name="productID" value="<?php echo $product['pID'] ?>">Add to Cart</button>
            </form>
        </div>
    </div>
</section>
<div id="footer-placeholder"></div>
</body>
<script src="JS/header_loader.js"></script>
<script src="JS/footer_loader.js"></script>
</html>