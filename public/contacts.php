<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/contact.css">
    <?php session_start()?>
</head>

<body>
<?php include 'layout/header.php'; ?>
<section id="contact-us">
  <h1>Contact Us</h1>
  <p>If you have any inquiries, concern, or in need of clarifications.</p>
  <form action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    <input type="submit" value="Submit">
  </form>
</section>
<?php include 'layout/footer.php'; ?>
</body>
<script src="JS/header_loader.js"></script>
<script src="JS/footer_loader.js"></script>
</html>