<?php
require_once("../controllers/db_model.php");

    if(isset($_POST['stockProduct'])) {
        $stockProduct = filter_input(INPUT_POST, 'stockProduct', FILTER_SANITIZE_STRING);
        $stockManufactureDate = filter_input(INPUT_POST, 'stockManufactureDate', FILTER_SANITIZE_STRING);
        $stockQty = filter_input(INPUT_POST, 'stockQty', FILTER_SANITIZE_STRING);

        $stmt = $conn->prepare("INSERT INTO stocks (pID, sMfgDate, sQty) VALUES (?, ?, ?)");
        $stmt->execute([$stockProduct, $stockManufactureDate, $stockQty]);    
    }

    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Stock</title>
    <link rel="stylesheet" href="css/add-product.css">
    <script src="js/navbar-loader.js" defer></script>
</head>
<body>
    <div id="navbar-container"></div>

    <section id="main-container">
        <main>
            <form action="add-stock.php" method="post">
                <label for="stockProduct">Product:</label>
                <select name="stockProduct" id="stockProduct">
                <?php
                    foreach ($products as $product) {
                        echo "<option value='".$product['pID']."'>".$product['pName']."</option>";
                    }
                ?>
                </select>
                <br>
                <label for="stockManufactureDate">Manufacture Date:</label>
                <input type="datetime-local" name="stockManufactureDate" id="stockManufactureDate" value="<?php echo date('Y-m-d\TH:i'); ?>">
                <br>
                <label for="stockQty">Quantity:</label>
                <input type="number" name="stockQty" id="stockQty" value="0" min="1">
                <br>
                <input type="submit" value="Add Stock">
            </form>
        </main>
    </section>
</body>
</html>
