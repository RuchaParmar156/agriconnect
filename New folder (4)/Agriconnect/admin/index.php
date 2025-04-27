<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Fetch summary statistics from the database
$totalUsersStmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
$totalUsers = $totalUsersStmt->fetch(PDO::FETCH_ASSOC)['total_users'];

$totalFarmersStmt = $pdo->query("SELECT COUNT(*) as total_farmers FROM users WHERE role = 'farmer'");
$totalFarmers = $totalFarmersStmt->fetch(PDO::FETCH_ASSOC)['total_farmers'];

$totalBuyersStmt = $pdo->query("SELECT COUNT(*) as total_buyers FROM users WHERE role = 'buyer'");
$totalBuyers = $totalBuyersStmt->fetch(PDO::FETCH_ASSOC)['total_buyers'];

$totalCropsStmt = $pdo->query("SELECT COUNT(*) as total_crops FROM crops");
$totalCrops = $totalCropsStmt->fetch(PDO::FETCH_ASSOC)['total_crops'];

$totalOrdersStmt = $pdo->query("SELECT COUNT(*) as total_orders FROM orders");
$totalOrders = $totalOrdersStmt->fetch(PDO::FETCH_ASSOC)['total_orders'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - AgriConnect</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Optional custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="css/admin-index.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    /* Custom Card Styles */
    .dashboard-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .dashboard-card .card-body {
      padding: 1.5rem;
    }
    .dashboard-card .card-title {
      font-size: 1.25rem;
      font-weight: bold;
    }
    .dashboard-card .display-4 {
      font-size: 2.5rem;
      font-weight: 700;
    }
    .dashboard-card .btn-light {
      font-size: 0.9rem;
      margin-top: 0.75rem;
    }
    /* Custom Background Gradients for Each Card */
    .bg-gradient-primary {
      background: linear-gradient(135deg, #007bff, #0056b3);
    }
    .bg-gradient-success {
      background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    .bg-gradient-info {
      background: linear-gradient(135deg, #17a2b8, #117a8b);
    }
    .bg-gradient-warning {
      background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    .bg-gradient-danger {
      background: linear-gradient(135deg, #dc3545, #bd2130);
    }
    /* Icon styling */
    .card-icon {
      font-size: 2rem;
      margin-right: 0.5rem;
    }
  </style>
</head>
<body>
  <!-- Include the common navbar -->
  <?php include 'navbar.php'; ?>

  <!-- Dashboard Content -->
  <div class="container mt-4">
    <h1 class="mb-4">Welcome, Admin!</h1>
    <div class="row g-4">
      <!-- Total Users Card -->
      <div class="col-md-4">
        <div class="card dashboard-card bg-gradient-primary text-white">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <i class="bi bi-people-fill card-icon"></i>
              <h5 class="card-title mb-0">Total Users</h5>
            </div>
            <p class="card-text display-4"><?php echo htmlspecialchars($totalUsers); ?></p>
            <a href="users.php" class="btn btn-light btn-sm">View Users</a>
          </div>
        </div>
      </div>
      <!-- Total Farmers Card -->
      <div class="col-md-4">
        <div class="card dashboard-card bg-gradient-success text-white">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <i class="bi bi-person-check-fill card-icon"></i>
              <h5 class="card-title mb-0">Total Farmers</h5>
            </div>
            <p class="card-text display-4"><?php echo htmlspecialchars($totalFarmers); ?></p>
            <a href="users.php" class="btn btn-light btn-sm">View Farmers</a>
          </div>
        </div>
      </div>
      <!-- Total Buyers Card -->
      <div class="col-md-4">
        <div class="card dashboard-card bg-gradient-info text-white">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <i class="bi bi-person-lines-fill card-icon"></i>
              <h5 class="card-title mb-0">Total Buyers</h5>
            </div>
            <p class="card-text display-4"><?php echo htmlspecialchars($totalBuyers); ?></p>
            <a href="users.php" class="btn btn-light btn-sm">View Buyers</a>
          </div>
        </div>
      </div>
      <!-- Total Crops Card -->
      <div class="col-md-6">
        <div class="card dashboard-card bg-gradient-warning text-white">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <i class="bi bi-card-checklist card-icon"></i>
              <h5 class="card-title mb-0">Total Crops</h5>
            </div>
            <p class="card-text display-4"><?php echo htmlspecialchars($totalCrops); ?></p>
            <a href="crops.php" class="btn btn-light btn-sm">Manage Crops</a>
          </div>
        </div>
      </div>
      <!-- Total Orders Card -->
      <div class="col-md-6">
        <div class="card dashboard-card bg-gradient-danger text-white">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <i class="bi bi-cart-fill card-icon"></i>
              <h5 class="card-title mb-0">Total Orders</h5>
            </div>
            <p class="card-text display-4"><?php echo htmlspecialchars($totalOrders); ?></p>
            <a href="orders.php" class="btn btn-light btn-sm">Manage Orders</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
