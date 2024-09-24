<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="css/orders.css">
    <script src="js/navbar-loader.js" defer></script>

    <?php
        session_start();
        require('../controllers/db_model.php');

        if(isset($_POST['materialName'])){
            $stmt = $conn->prepare("INSERT INTO materials (mName, mMeasurement) VALUES (?, ?)");
            $stmt->execute([$_POST['materialName'], $_POST['materialMeasurement']]);
            header('inventory.php');
        }

        $stmt = $conn->prepare("SELECT * FROM materials");
        $stmt->execute();
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

</head>
<body>
    <div id="navbar-container"></div>

    <section id="main-container">
        <main>
            <h1 class="page-title">Add New Material</h1>
            <form action="inventory.php" method="POST">
                <label for="materialName">Material Name:</label>
                <input type="text" name="materialName" id="materialName" require><br>

                <label for="materialMeasurement">Material Measurement:</label>
                <label>Volume (ml):</label>
                <input type="radio" name="materialMeasurement" value="ml" required>
                <label>Mass (g):</label>
                <input type="radio" name="materialMeasurement" value="g" required>
                <label>Pieces (pcs):</label>
                <input type="radio" name="materialMeasurement" value="pcs" required>
                <br>

                <input type="submit" value="Add Material">
            </form>

    <section id="main-container">
       
        <main>
            <form action="orders.php" method="POST">
            <h1 class="page-title">Manage Inventory</h1>
            <div class="tab-content" id="pending">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Material ID</th>
                            <th>Material Name</th>
                            <th>Material Measurement</th>
                            <th>Total Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($materials as $material){
                            echo '<tr>
                                <td>'.$material['mID'].'</td>
                                <td>'.$material['mName'].'</td>
                                <td>'.$material['mMeasurement'].'</td>
                                <td></td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </form>
        </main>
    </section>
</body>
</html>