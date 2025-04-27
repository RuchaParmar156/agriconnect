<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in and is a farmer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: ../login.php");
    exit;
}

$farmer_id = $_SESSION['user_id'];

// Fetch orders for crops that belong to the logged-in farmer
$stmt = $pdo->prepare("
    SELECT orders.*, crops.name AS crop_name, users.username AS buyer_name 
    FROM orders 
    JOIN crops ON orders.crop_id = crops.id 
    JOIN users ON orders.buyer_id = users.id 
    WHERE crops.farmer_id = ? 
    ORDER BY orders.order_date DESC
");
$stmt->execute([$farmer_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Orders - AgriConnect Farmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Include common navigation for farmers -->
  <?php include 'nav.php'; ?>
  
  <div class="container mt-4">
    <h1 class="mb-4">Orders on Your Crops</h1>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Order Date</th>
            <th>Crop Name</th>
            <th>Buyer Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($orders): ?>
            <?php foreach ($orders as $order): ?>
              <tr>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                <td><?php echo htmlspecialchars($order['crop_name']); ?></td>
                <td><?php echo htmlspecialchars($order['buyer_name']); ?></td>
                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">No orders found for your crops.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
