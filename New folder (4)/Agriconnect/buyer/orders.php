<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a buyer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'buyer') {
    header("Location: ../login.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];

// Fetch order history for the logged-in buyer
$orderStmt = $pdo->prepare("
    SELECT orders.*, crops.name AS crop_name 
    FROM orders 
    JOIN crops ON orders.crop_id = crops.id 
    WHERE orders.buyer_id = ? 
    ORDER BY orders.order_date DESC
");
$orderStmt->execute([$buyer_id]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Orders - AgriConnect Buyer</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Optional custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    /* Order Card Styling */
    .order-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 20px;
    }
    .order-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .order-card .card-header {
      background-color: #0d6efd;
      color: #fff;
      padding: 0.75rem 1.25rem;
      font-weight: bold;
      font-size: 1rem;
    }
    .order-card .card-body {
      padding: 1.25rem;
      background-color: #fff;
    }
    .order-card .card-body p {
      margin: 0.5rem 0;
    }
    .order-card .card-footer {
      background-color: #f8f9fa;
      padding: 0.75rem 1.25rem;
      text-align: right;
    }
  </style>
</head>
<body>
  <!-- Include the common navigation bar -->
  <?php include 'nav.php'; ?>

  <div class="container my-5">
    <h1 class="mb-4">Your Order History</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php if ($orders): ?>
        <?php foreach ($orders as $order): ?>
          <div class="col">
            <div class="card order-card shadow-sm">
              <!-- Card Header with Order Date -->
              <div class="card-header">
                Order Date: <?php echo htmlspecialchars($order['order_date']); ?>
              </div>
              <!-- Card Body with Order Details -->
              <div class="card-body">
                <h5 class="card-title text-primary"><?php echo htmlspecialchars($order['crop_name']); ?></h5>
                <p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($order['quantity']); ?></p>
                <p class="card-text"><strong>Total Price:</strong> $<?php echo htmlspecialchars($order['total_price']); ?></p>
                <p class="card-text"><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
              </div>
              <!-- Card Footer for Additional Actions (optional) -->
              <!-- <div class="card-footer"> -->
                <!-- Optionally add a 'View Details' or similar button -->
                <!-- <a href="order-details.php?id=<?php echo $order['id']; ?>" class="btn btn-outline-secondary btn-sm">View Details</a> -->
              <!-- </div>s -->
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col">
          <div class="alert alert-info text-center" role="alert">
            You have not placed any orders yet.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

