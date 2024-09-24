<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <title>Login</title>

    <?php
        session_start();
        require_once("../controllers/db_model.php");
        if (isset($_POST['emailAddress'])) {
            $emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $stmt = $conn->prepare("SELECT * FROM users WHERE uEmail = ? AND uPass = ?");

            $stmt->execute([$emailAddress, $password]);
            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user['uType'] == 1) {
                    $_SESSION['userID'] = $user['uID'];
                    header("Location: products.php");
                    exit;
                } else if ($user['uType'] == 3) {
                    $_SESSION['userID'] = $user['uID'];
                    header("Location: ../admin/admin.php");
                    exit;
                }
            } else {
                header("Location: log.php");
                exit;
            }
        }
    ?>
</head>

<body>
<?php include 'layout/header.php'; ?>
<section id="login-section">

    <form action="log.php" method="POST">
        <h1>Login</h1>
        <p>Please input your correct credentials to login.</p>
        <label for="emailAddress">Email Address:</label>
        <input type="text" placeholder="Username" required id="email-address" name="emailAddress" >
        <label for="password">Password:</label>
        
        <input type="password" placeholder="Password"  id="password" name="password">
        <button type="submit">Login</button>
        <div class="quote-container">
        <p id="register-quote">Don't have an account? <a href="">Sign up instead!</a> </p>
    </div>
    </form>
</section>
<?php include 'layout/footer.php'; ?>
</body>
<script src="JS/header_loader.js"></script>
<script src="JS/footer_loader.js"></script>
</html>