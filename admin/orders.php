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

        if(isset($_POST['updateOrder'])){
            $stmt = $conn->prepare("UPDATE transactions SET tStatus = tStatus + 1 WHERE tID = ?");
            $stmt->execute([$_POST['updateOrder']]);
        }

        if(isset($_POST['cancelOrder'])){
            $stmt = $conn->prepare("UPDATE transactions SET tStatus = 0 WHERE tID = ?");
            $stmt->execute([$_POST['cancelOrder']]);
        }
            
        function displayOrders($status) {
            global $conn;

            $stmt = $conn->prepare('SELECT t.tID AS tID,
                                            t.tType AS tType,
                                            t.tStatus AS tStatus,
                                            CONCAT(u.uFName, " ", u.uLName) AS uName,
                                            p.pName AS pName,
                                            o.oQty AS oQty,
                                            p.pPrice * o.oQty AS total,
                                            DATE_FORMAT(DATE_ADD(t.tDateOrder, INTERVAL 5 DAY), "%M %d, %Y") AS tDateOrder
                                    FROM orders o
                                    INNER JOIN transactions t ON t.tID = o.tID
                                    INNER JOIN users u ON t.uID = u.uID
                                    INNER JOIN products p ON o.pID = p.pID
                                    WHERE t.tStatus = ?
                                    ORDER BY `t`.`tID` ASC');

            $stmt->execute([$status]);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            for($i = 0; $i< count($orders); $i++) {
                $currentTransaction = $orders[$i]['tID'];
                $maxTransaction = count($orders);

                echo '<tr>
                        <td>'.$orders[$i]['tID'].'</td>
                        <td>'.$orders[$i]['uName'].'</td>
                        <td>';
                // LIST ALL PRODUCTS IN A TRANSACTION
                $x = $i;
                do{
                    echo "x".$orders[$x]['oQty']." ".$orders[$x]['pName']."<br>";
                    $x+=1;
                    if ($x == $maxTransaction) break;
                }while($orders[$x]['tID'] == $currentTransaction);
                echo "</td><td>";

                // LIST TOTAL FOR EACH ORDER IN TRANSACTION
                $x = $i;
                do{
                    echo $orders[$x]['total']."<br>";
                    $x+=1;
                    if ($x == $maxTransaction) break;
                }while($orders[$x]['tID'] == $currentTransaction);
                echo "</td><td>";

                // LIST TOTAL OF ALL ORDERS IN TRANSACTION
                $itemTotal = 0;
                $x = $i;
                do{
                    $itemTotal+=$orders[$x]['total'];
                    $x+=1;
                    if ($x == $maxTransaction) break;
                }while($orders[$x]['tID'] == $currentTransaction);
                echo $itemTotal;
                echo "</td><td>";
                
                // LIST DEADLINE
                echo $orders[$i]['tDateOrder'];
                echo "</td>";
                // ACTIONS
                if($orders[$i]['tStatus'] < 5){
                    echo "<td>
                        <button name='updateOrder' value=".$orders[$i]['tID']." class='btn update'>";
                    switch ($orders[$i]['tStatus']) {
                        case 2:
                            echo "Confirm and Paid";
                            break;
                        case 3:
                            echo "Done";
                            break;
                        case 4:
                            if($orders[$i]['tType'] == 1){
                                echo "Received";
                            }else{
                                echo "Picked Up";
                            }
                            break;
                        }
                    echo "</button>";
                    if($orders[$i]['tStatus'] <= 3){
                        echo "<button name='cancelOrder' value=".$orders[$i]['tID']." class='btn delete'>";
                        switch ($orders[$i]['tStatus']) {
                            case 2:
                                echo "Deny";
                                break;
                            case 3:
                                echo "Cancel/ Refund";
                                break;
                            }
                        echo"</button>";
                    }
                    echo "</td>";
                }
                echo "</tr>";
                
                //LOOK FOR THE NEXT TRANSACTION IF TRANSACTION HAS MULTIPLE ORDERS
                while(isset($orders[$i+1]) && $orders[$i+1]['tID'] == $currentTransaction){
                    $i++;
                }
                echo " ";
            }
        }
    ?>

    

</head>
<body>
    <div id="navbar-container"></div>

    <section id="main-container">
       
        <main>
            <form action="orders.php" method="POST">
            <h1 class="page-title">Manage Orders</h1>
            <ul class="tabs">
                <li class="tab-link active" data-tab="pending">Pending Orders</li>
                <li class="tab-link" data-tab="processing">Processing Orders</li>
                <li class="tab-link" data-tab="claim">For Claim</li>
                <li class="tab-link" data-tab="done">Complete Orders</li>
                <li class="tab-link" data-tab="failed">Failed Orders</li>
            </ul>
            <div class="tab-content" id="pending">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Total Price</th>
                            <th>Total Payment <br> (+ Shipping)</th>
                            <th>Expected Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php displayOrders(2);?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content" id="processing" style="display: none;">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Total Price</th>
                            <th>Total Payment <br> (+ Shipping)</th>
                            <th>Expected Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php displayOrders(3);?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content" id="claim" style="display: none;">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Total Price</th>
                            <th>Total Payment <br> (+ Shipping)</th>
                            <th>Expected Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php displayOrders(4);?>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="tab-content" id="done" style="display: none;">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Total Price</th>
                            <th>Total Payment <br> (+ Shipping)</th>
                            <th>Expected Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php displayOrders(5);?>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="tab-content" id="failed" style="display: none;">
                <div class="sort-options">
                    <select class="sort-dropdown">
                        <option value="all">All</option>
                        <option value="month">By Month</option>
                        <option value="week">By Week</option>
                        <option value="day">By Day</option>
                    </select>
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Failure Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php displayOrders(0);?>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
    </form>
        </main>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            tabLinks.forEach(link => {
                link.addEventListener('click', () => {
                    tabLinks.forEach(l => l.classList.remove('active'));
                    tabContents.forEach(content => content.style.display = 'none');

                    link.classList.add('active');
                    document.getElementById(link.dataset.tab).style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>