<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/cart.css">
    <title>Cart</title>
        <?php
            $total = 0;
            $orders = [];

            session_start();
            //GET USER'S TRANSACTION WITH ON-CART STATUS
            require('../controllers/db_model.php');
            $stmt = $conn->prepare("SELECT tID FROM transactions WHERE uID = ? AND tStatus = 1");
            $stmt->execute([$_SESSION['userID']]);
            $transaction = $stmt->fetchColumn();

            // CHECKOUT
            if (isset($_POST['checkout'])) {
                if($transaction){
                    $stmt = $conn->prepare("UPDATE transactions SET tStatus = 2, tDateOrder = NOW() WHERE tID = ?");
                    $stmt->execute([$transaction]);
                    header('cart.php');
                    $transaction = null;
                }
            }
            
            if($transaction){
                // GET ALL PRODUCTS IN CART
                $stmt = $conn->prepare("SELECT pid, oQty FROM orders WHERE tID = ?");
                $stmt->execute([$transaction]);
                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // GET PRODUCT DETAILS FOR EACH ORDER
                $stmt = $conn->prepare("SELECT pName, pID, pPrice FROM products WHERE pID IN (".implode(',', array_map(function($val) {
                    return (int)$val['pid'];
                }, $orders)).")");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // GET TOTAL
                for($i = 0; $i < count($orders); $i++){
                    $total += $products[$i]['pPrice'] * $orders[$i]['oQty'];
                }
                
            }
        ?>
</head>
<body>
    <?php include 'layout/header.php'; ?>

    <section id="cart-section">
        <div class="cart-content">
            <div class="cart-items">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Thumbnail</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i = 0; $i < count($orders); $i++){
                                echo '<tr>
                                        <td><button class="remove-item">×</button></td>
                                        <td><img src="assets/cake-thumbnail.jpg" alt="Cake Image" class="item-image"></td>
                                        <td>'.$products[$i]['pName'].'</td>
                                        <td>₱'.$products[$i]['pPrice'].'</td>
                                        <td><input type="number" value="'.$orders[$i]['oQty'].'" min="1" class="quantity-input"></td>
                                        <td>₱'.$orders[$i]['oQty'] * $products[$i]['pPrice'].'</td>
                                        </tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <button class="update-cart">Update Cart</button>
            </div>

            <div class="price-breakdown">
                <div class="price-summary">
                    <p class="summary-label">Subtotal:</p>
                    <p class="summary-amount">₱<?php echo $total?></p>
                </div>
                <div class="shipping-options">
                    <p>Shipping Options</p>
                    <form>
                        <div class="shipping-option">
                            <input type="radio" id="san-rafael" name="shipping" value="70">
                            <label for="san-rafael">San Rafael, Bulacan: ₱70</label>
                        </div>
                        <div class="shipping-option">
                            <input type="radio" id="san-ildefonso" name="shipping" value="50">
                            <label for="san-ildefonso">San Ildefonso, Bulacan: ₱50</label>
                        </div>
                        <div class="shipping-option">
                            <input type="radio" id="san-miguel" name="shipping" value="80">
                            <label for="san-miguel">San Miguel, Bulacan: ₱80</label>
                        </div>
                        <div class="shipping-option">
                            <input type="radio" id="pick-up" name="pick-up" value="80">
                            <label for="san-miguel">Pick Up</label>
                        </div>
                    </form>
                </div>
                
                <div class="total-amount">
                    <hr>
                    <p>Total:</p>
                    <p class="total-price">₱<?php echo $total?></p>
                </div>
                <form action="cart.php" method="post">
                    <button type="submit" name="checkout" value="true" class="checkout-button">Proceed to Checkout</button>
                </form>
            </div>
        </div>
    </section>

    <?php include 'layout/footer.php'; ?>
</body>
<script src="JS/header_loader.js"></script>
<script src="JS/footer_loader.js"></script>
</html>
