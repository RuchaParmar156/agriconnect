<?php
session_start();
require_once '../connection.php';

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Users - AgriConnect Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Optional custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }
    .user-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 20px;
    }
    .user-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .user-card .card-header {
      background-color: #0d6efd;
      color: #fff;
      padding: 0.75rem 1.25rem;
      font-weight: bold;
      font-size: 1.1rem;
    }
    .user-card .card-body {
      background-color: #fff;
      padding: 1.25rem;
    }
    .user-card .card-body p {
      margin: 0.5rem 0;
    }
    .user-card .card-footer {
      background-color: #f8f9fa;
      padding: 0.75rem 1.25rem;
      text-align: right;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="container mt-4">
    <h1 class="mb-4">Manage Users</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php if ($users): ?>
        <?php foreach ($users as $user): ?>
          <div class="col">
            <div class="card user-card shadow-sm">
              <div class="card-header">
                <?php echo htmlspecialchars($user['username']); ?> (ID: <?php echo htmlspecialchars($user['id']); ?>)
              </div>
              <div class="card-body">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                <p><small class="text-muted">Joined: <?php echo htmlspecialchars($user['created_at']); ?></small></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col">
          <div class="alert alert-warning text-center" role="alert">
            No users found.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
