<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a buyer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'buyer') {
    header("Location: ../login.php");
    exit;
}

// Validate crop ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: buyer-dashboard.php");
    exit;
}

$crop_id = intval($_GET['id']);

// Fetch crop details (only if available)
$stmt = $pdo->prepare("SELECT * FROM crops WHERE id = ? AND available = 1");
$stmt->execute([$crop_id]);
$crop = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$crop) {
    $_SESSION['error'] = "The requested crop is not available.";
    header("Location: buyer-dashboard.php");
    exit;
}

$error = '';
$success = '';

// Process order form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Since buyers must purchase the entire available quantity,
    // we automatically set the order quantity to the current crop quantity.
    $order_quantity = intval($crop['quantity']);

    if ($order_quantity <= 0) {
        $error = "There is no available stock to purchase.";
    } else {
        $total_price = $order_quantity * $crop['price'];
        $buyer_id = $_SESSION['user_id'];

        // Insert order into orders table (assuming default status is 'pending')
        $stmt = $pdo->prepare("INSERT INTO orders (buyer_id, crop_id, quantity, total_price, status) VALUES (?, ?, ?, ?, 'pending')");
        if ($stmt->execute([$buyer_id, $crop_id, $order_quantity, $total_price])) {
            // Update crop: set quantity to 0 and mark as not available
            $updateStmt = $pdo->prepare("UPDATE crops SET quantity = 0, available = 0 WHERE id = ?");
            $updateStmt->execute([$crop_id]);

            $success = "Order placed successfully! You have purchased the entire quantity.";
        } else {
            $error = "Failed to place order. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Crop - AgriConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/order-crop.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="buyer-dashboard.php">AgriConnect</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="buyer-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Order Crop Section -->
    <div class="container mt-4">
        <h1>Order Crop</h1>
        <div class="card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars($crop['name']); ?></h3>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> <?php echo htmlspecialchars($crop['description']); ?></p>
                <p><strong>Price per Unit:</strong> $<?php echo htmlspecialchars($crop['price']); ?></p>
                <p><strong>Available Quantity:</strong> <?php echo htmlspecialchars($crop['quantity']); ?></p>
                <p class="fw-bold">Note: You must buy the entire quantity available.</p>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                    <a href="buyer-dashboard.php" class="btn btn-primary">Back to Dashboard</a>
                <?php else: ?>
                    <!-- Instead of a quantity input, we simply provide a button to confirm the purchase -->
                    <form action="order.php?id=<?php echo $crop_id; ?>" method="POST">
                        <button type="submit" class="btn btn-success">Buy Entire Quantity</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
