<?php
session_start();
require_once '../connection.php';

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all orders with crop and buyer details
$stmt = $pdo->prepare("
    SELECT orders.*, crops.name AS crop_name, users.username AS buyer_name 
    FROM orders 
    JOIN crops ON orders.crop_id = crops.id 
    JOIN users ON orders.buyer_id = users.id 
    ORDER BY orders.order_date DESC
");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process status update if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['new_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['new_status'];
    
    $updateStmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $updateStmt->execute([$newStatus, $orderId]);
    header("Location: orders.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Orders - AgriConnect Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Optional custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="css/admin-index.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    /* Card styling for orders */
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
      background-color: #fff;
      padding: 1.25rem;
    }
    .order-card .card-body p {
      margin-bottom: 0.5rem;
    }
    .order-card .card-footer {
      background-color: #f8f9fa;
      padding: 0.75rem 1.25rem;
      text-align: right;
    }
    /* Form styling */
    .order-form select.form-select {
      width: auto;
      display: inline-block;
    }
    .order-form button {
      display: inline-block;
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="container my-5">
    <h1 class="mb-4">Manage Orders</h1>
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
                <p class="card-text"><strong>Buyer:</strong> <?php echo htmlspecialchars($order['buyer_name']); ?></p>
                <p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($order['quantity']); ?></p>
                <p class="card-text"><strong>Total Price:</strong> $<?php echo htmlspecialchars($order['total_price']); ?></p>
                <p class="card-text"><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
              </div>
              <!-- Card Footer with Update Status Form -->
              <div class="card-footer">
                <form method="POST" action="orders.php" class="order-form">
                  <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                  <select name="new_status" class="form-select form-select-sm me-2" required>
                    <option value="">Select Status</option>
                    <option value="pending" <?php echo ($order['status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="completed" <?php echo ($order['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="cancelled" <?php echo ($order['status'] === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col">
          <div class="alert alert-info text-center" role="alert">
            No orders found.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

