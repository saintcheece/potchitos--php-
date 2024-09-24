<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
    <nav class="top-navigation-bar">
        <div class="logo">Admin Dashboard</div>
        <div class="menu">
            <ul>
                <li><a href="admin.php">Home</a></li>
                <li class="dropdown">
                    <a href="#">Products</a>
                    <div class="dropdown-content">
                        <a href="manage-products.php">Manage Products</a>
                        <a href="add-product.php">Add New Product</a>
                    </div>
                </li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="#">Tasks</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="#">Staffs</a></li>
            </ul>
        </div>
        <div class="user-actions">
            <p class="email">email@example.com</p>
            <a href="../logout.php"><div class="logout" >Logout</div></a>
        </div>
    </nav>
</body>
</html>
