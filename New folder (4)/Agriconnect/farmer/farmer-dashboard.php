<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a farmer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: ../login.php");
    exit;
}

$farmerId = $_SESSION['user_id'];

// Fetch crops listed by the logged-in farmer
$stmt = $pdo->prepare("SELECT * FROM crops WHERE farmer_id = ?");
$stmt->execute([$farmerId]);
$crops = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch orders for crops that belong to the logged-in farmer
$orderStmt = $pdo->prepare("
    SELECT orders.*, crops.name AS crop_name, users.username AS buyer_name 
    FROM orders 
    JOIN crops ON orders.crop_id = crops.id 
    JOIN users ON orders.buyer_id = users.id 
    WHERE crops.farmer_id = ? 
    ORDER BY orders.order_date DESC
");
$orderStmt->execute([$farmerId]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Farmer Dashboard - AgriConnect</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Optional custom CSS files -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/farmer-dashboard.css" />
    <style>
      body {
        background-color: #f8f9fa;
      }
      /* Style for the secondary (farmer) nav bar */
      .farmer-nav {
        background-color: #e9ecef;
        border-bottom: 1px solid #dee2e6;
      }
      .farmer-nav .nav-link {
        color: #495057;
      }
      .farmer-nav .nav-link.active,
      .farmer-nav .nav-link:hover {
        color: #0d6efd;
      }
      /* Optional: add spacing below nav bars */
      .content-wrapper {
        padding-top: 1rem;
      }
    </style>
  </head>
  <body>
<?php include 'nav.php'; ?>


    <!-- Main Content Area -->
    <div class="container content-wrapper mt-4">
      <h1>Welcome, Farmer!</h1>
      <p class="lead">Manage your crops and orders easily.</p>

      <?php include 'latest-crop.php'; ?>

      <?php include 'ordered-crops.php'; ?>
      
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

