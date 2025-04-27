<?php
// my-crop.php

session_start();
require_once '../connection.php';

// Ensure the user is logged in and is a farmer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: ../login.php");
    exit;
}

$farmer_id = $_SESSION['user_id'];

// Fetch the crops for the logged-in farmer
$stmt = $pdo->prepare("SELECT * FROM crops WHERE farmer_id = ?");
$stmt->execute([$farmer_id]);
$crops = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Crops - AgriConnect</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Optional custom CSS files -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/farmer-dashboard.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    /* Card layout for My Crops */
    .crop-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .crop-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .crop-card .card-body {
      background: #fff;
      padding: 1.5rem;
    }
    .crop-card .card-title {
      font-weight: bold;
      color: #007bff;
    }
    .crop-card .list-group-item {
      font-size: 14px;
      color: #333;
    }
    .crop-card .card-footer {
      background: #f8f9fa;
      padding: 0.75rem 1.5rem;
    }
  </style>
</head>
<body>
  <?php include 'nav.php'; ?>
  
  <!-- Main Content Area -->
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>My Crops</h1>
      <a href="add-crop.php" class="btn btn-success">Add New Crop</a>
    </div>
    
    <?php if (!empty($crops)): ?>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($crops as $crop): ?>
          <div class="col">
            <div class="card crop-card shadow-sm">
              <!-- Optionally, you can add a header image if available -->
              <?php if (!empty($crop['image'])): ?>
                <img src="<?php echo htmlspecialchars($crop['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($crop['name']); ?>">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($crop['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($crop['description']); ?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Price:</strong> $<?php echo htmlspecialchars($crop['price']); ?></li>
                <li class="list-group-item"><strong>Quantity:</strong> <?php echo htmlspecialchars($crop['quantity']); ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?php echo $crop['available'] ? 'Available' : 'Sold Out'; ?></li>
              </ul>
              <div class="card-footer d-flex justify-content-end">
                <a href="edit-crop.php?id=<?php echo $crop['id']; ?>" class="btn btn-primary btn-sm me-1">Edit</a>
                <a href="delete-crop.php?id=<?php echo $crop['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this crop?');">Delete</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-warning text-center" role="alert">
        No crops found. Please add a new crop.
      </div>
    <?php endif; ?>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
