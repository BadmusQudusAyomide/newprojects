<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();
redirectIfNotAdmin();

$product_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$product_id]);

header('Location: manage_products.php');
?>
