<?php

session_start();
require("../conn.php");

// GET INPUT AND SANITIZE
$productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
$productDescription = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
$productPrice = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_STRING);
$

$sql = "INSERT INTO `products` (`pName`, `pDesc`, `pPrice`) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $productName, PDO::PARAM_STR);
$stmt->bindParam(2, $productDescription, PDO::PARAM_STR);
$stmt->bindParam(3, $productPrice, PDO::PARAM_STR);
$stmt->execute();

?>