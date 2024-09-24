<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="css/manage-product.css">
    <script src="js/navbar-loader.js" defer></script>
    <?php
        session_start();
        require('../controllers/db_model.php');
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
</head>
<body>
    <div id="navbar-container"></div>

    <section id="main-container">
      
        <main>
            <h1>Manage Products</h1>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example product row -->
                    <?php
                        foreach($products as $product){
                            echo '<tr>
                            <td><img src="path/to/product-image.jpg" alt="Product Image" class="product-image"></td>
                            <td>'.$product['pName'].'</td>
                            <td>'.$product['pPrice'].'</td>
                            <td>
                                <button class="btn enable">Enable</button>
                                <button class="btn disable">Disable</button>
                                <button class="btn delete">Delete</button>
                            </td>
                            </tr>';
                        }
                    ?>
                    <!-- Repeat above row for additional products -->
                </tbody>
            </table>
        </main>
    </section>
</body>
</html>
