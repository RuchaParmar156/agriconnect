<?php
session_start();
require_once '../connection.php';

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all crop listings along with the farmer's name
$stmt = $pdo->query("SELECT crops.*, users.username AS farmer_name 
                     FROM crops 
                     JOIN users ON crops.farmer_id = users.id 
                     ORDER BY crops.created_at DESC");
$crops = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Crops - AgriConnect Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Optional custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="css/admin-index.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .manage-crops-container {
      margin-top: 2rem;
    }
    .crop-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .crop-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .crop-card .card-header {
      background-color: #0d6efd;
      color: #fff;
      padding: 0.75rem 1.25rem;
      font-weight: bold;
      font-size: 1.1rem;
    }
    .crop-card .card-body {
      background-color: #fff;
      padding: 1.25rem;
    }
    .crop-card .card-body p {
      margin-bottom: 0.5rem;
    }
    .crop-card .card-footer {
      background-color: #f8f9fa;
      padding: 0.75rem 1.25rem;
      text-align: right;
    }
    .badge-available {
      background-color: #28a745;
    }
    .badge-unavailable {
      background-color: #dc3545;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="container manage-crops-container">
    <h1 class="mb-4">Manage Crops</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php if ($crops): ?>
        <?php foreach ($crops as $crop): ?>
          <div class="col">
            <div class="card crop-card shadow-sm">
              <!-- Card Header: Crop Name -->
              <div class="card-header">
                <?php echo htmlspecialchars($crop['name']); ?>
              </div>
              <!-- Card Body: Crop Details -->
              <div class="card-body">
                <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($crop['description']); ?></p>
                <p class="card-text"><strong>Price:</strong> $<?php echo htmlspecialchars($crop['price']); ?></p>
                <p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($crop['quantity']); ?></p>
                <p class="card-text"><strong>Farmer:</strong> <?php echo htmlspecialchars($crop['farmer_name']); ?></p>
                <p class="card-text">
                  <strong>Available:</strong>
                  <?php if ($crop['available']): ?>
                    <span class="badge badge-available">Yes</span>
                  <?php else: ?>
                    <span class="badge badge-unavailable">No</span>
                  <?php endif; ?>
                </p>
                <p class="card-text"><small class="text-muted">Created: <?php echo htmlspecialchars($crop['created_at']); ?></small></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col">
          <div class="alert alert-warning text-center" role="alert">
            No crops found.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

