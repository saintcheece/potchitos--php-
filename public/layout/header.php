
<head>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<header>
    <nav>
      <div class="image-container">
        <a href="/potchitos/public/home.php"><img src="\potchitos\public\assets\images\blue-potchitos-logo1.png" alt=""></a>
      </div>
      <ul>
        <li>
          <a href="about.php">About Us</a>
        </li>
        <li>
          <a href="products.php">Products</a>
        </li>
        <li>
          <a href="booths.php">Booth</a>
        </li>
        <li>
          <a href="contacts.php">Contact Us</a>
        </li>
        
        <?php 
          if(isset($_SESSION['userID']) && $_SESSION['userID'] != null) { 
            echo '<li>
                    <a href="cart.php">
                      <i class="fas fa-shopping-cart" id="cart-icon"></i>
                    </a>
                    </li>
                    <li>
                    <a href="../logout.php" id="login-button">Log Out</a>
                    </li>';
          }else{
            echo '<li>
                    <a href="log.php" id="login-button">Login</a>
                    </li>';
          }
        ?>
      </ul>
    </nav>
  </header>