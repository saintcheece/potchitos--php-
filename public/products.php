<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/products.css">
    <title>Products</title>
    <?php 
        session_start();
        require('../controllers/db_model.php');
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                    $stmt = $conn->prepare("UPDATE orders SET oQty = oQty + 1 WHERE oID = ?");
                    $stmt->execute([$orderID]);
                } else {
                    // add this product to the db
                    $stmt = $conn->prepare("INSERT INTO orders (tID, pID, oQty) VALUES (?, ?, 1)");
                    $stmt->execute([$transactionID, $productID]);
                }
            } else {
                // if no transaction exists, create one
                $stmt = $conn->prepare("INSERT INTO transactions (uID, tType, tStatus) VALUES (?, 2, 1)");
                $stmt->execute([$_SESSION['userID']]);
                $transactionID = $conn->lastInsertId();
                $stmt = $conn->prepare("INSERT INTO orders (tID, pID, oQty) VALUES (?, ?, 1)");
                $stmt->execute([$transactionID, $productID]);
            }
        }

        //DISPLAY CARDS
        function displayProductCards($products, $type) {
            foreach ($products as $product) {
                if($product['pType'] == $type){
                    echo '<div class="product-card">
                            <a href="product-details.php?id='.$product['pID'].'" class="product-link">
                            <img src="assets\images\blue-potchitos-logo.png" alt="Fruit 3">
                            <div class="product-info">
                            <h3>'.$product['pName'].'</h3>
                            <p>'.$product['pPrice'].'</p>';
                if(isset($_SESSION['userID']) && $_SESSION['userID'] != null) {
                    echo '<form action="products.php" method="post">
                            <button type="submit" name="productID" value="'.$product['pID'].'">Add to Cart</button>
                            </form>';
                }
                                
                echo '</div>
                        </a>
                        </div>';
                }
            }
        }
    ?>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <section id="products" class="products-container">
        <div class="sidebar">
            <div class="side-bar-title">
                <h2>Categories</h2>
            </div>
            <div class="side-bar-content">
                <ul class="category-list">
                    <li><a href="#">All</a></li>
                    <li><a href="#">Buns</a></li>
                    <li><a href="#">Cookies</a></li>
                    <li><a href="#">Custom Cakes</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <!-- Buns Section -->
            <div class="product-category">
                <h2>Buns</h2>
                <div class="product-container">
                    <?php
                        displayProductCards($products, 1);
                    ?>
                </div>
            </div>

            <!-- Cookies Section -->
            <div class="product-category">
                <h2>Cookies</h2>
                <div class="product-container">
                    <?php
                        displayProductCards($products, 2);
                    ?>
                </div>
            </div>

            <!-- Custom Cakes Section -->
            <div class="product-category">
                <h2>Custom Cakes</h2>
                <div class="product-container">
                    <?php
                        displayProductCards($products, 3);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php include 'layout/footer.php'; ?>
    
    <script src="../JS/header_loader.js"></script>
    <script src="../JS/footer_loader.js"></script>
</body>
</html>
