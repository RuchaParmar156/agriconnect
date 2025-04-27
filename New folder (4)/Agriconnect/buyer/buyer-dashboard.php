<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a buyer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'buyer') {
    header("Location: ../login.php");
    exit;
}

// Fetch all available crops along with the farmer's name
$stmt = $pdo->prepare("SELECT crops.*, users.username AS farmer_name FROM crops JOIN users ON crops.farmer_id = users.id WHERE crops.available = 1");
$stmt->execute();
$crops = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch order history for the logged-in buyer
$buyer_id = $_SESSION['user_id'];
$orderStmt = $pdo->prepare("SELECT orders.*, crops.name AS crop_name FROM orders JOIN crops ON orders.crop_id = crops.id WHERE orders.buyer_id = ? ORDER BY orders.order_date DESC");
$orderStmt->execute([$buyer_id]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard - AgriConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optionally include your own CSS files -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/buyer-dashboard.css">
</head>

<body>
    <?php 
    if(file_exists('nav.php')) {
        include 'nav.php';
    } else {
        echo "Navigation file not found";
    }
    
    if(file_exists('available-crops.php')) {
        include 'available-crops.php';
    } else {
        echo "Available crops file not found";
    }
    
    if(file_exists('order-history.php')) {
        include 'order-history.php';
    } else {
        echo "Order history file not found";
    }
    ?>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>