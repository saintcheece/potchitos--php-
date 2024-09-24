<?php
require_once("../controllers/db_model.php");
if (isset($_POST['productName'])) {
    $productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
    $productPrice = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_STRING);
    $productDescription = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
    $productShelfLife = filter_input(INPUT_POST, 'productShelfLife', FILTER_SANITIZE_STRING);
    $productType = filter_input(INPUT_POST, 'productType', FILTER_SANITIZE_STRING);

    // add this product to the db
    $newProduct = "INSERT INTO products (pName, pPrice, pDesc, pShelfLife, pType) 
                    VALUES ('$productName', '$productPrice', '$productDescription', '$productShelfLife', '$productType')";
    save($newProduct, "product");
    header("add-product.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="css/add-product.css">
    <script src="js/navbar-loader.js" defer></script>

</head>
<body>
    <div id="navbar-container"></div>

    <section id="main-container">
        
        <main>
            <h1 class="page-title">Add New Product</h1>
            <form action="add-product.php" method="POST" class="add-product-form">
                <div class="form-group">
                    <label for="fileField">Product Image:</label>
                    <input type="file" id="fileField" name="fileField">
                </div>
                <div class="form-group">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="product-name" name="productName" placeholder="Enter product name" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Product Description:</label>
                    <textarea id="product-description" name="productDescription" rows="4" placeholder="Enter product description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="productPrice">Product Price ($):</label>
                    <input type="number" id="product-price" name="productPrice" step="0.01" placeholder="Enter product price" required>
                </div>
                <div class="form-group">
                    <label for="productShelfLife">Product Shelf Life:</label>
                    <input type="number" id="product-shelflife" name="productShelfLife" step="0.01" placeholder="Enter product shelf life" required>
                </div>
                <div class="form-group">
                    <label for="productType">Product Shelf Life:</label>
                    <select id="product-type" name="productType" required>
                        <option value="">Select a category</option>
                        <option value="0">Miscellaneous</option>
                        <option value="1">Buns</option>
                        <option value="2">Cookies</option>
                        <option value="3">Cake</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit">Add Product</button>
                </div>
            </form>
        </main>
    </section>
</body>
</html>
