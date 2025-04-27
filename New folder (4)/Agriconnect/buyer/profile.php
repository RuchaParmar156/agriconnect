<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username) || empty($email)) {
        $error = 'Username and Email are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!empty($password) && $password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        if (!empty($password)) {
            // Update including password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $updateStmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            if ($updateStmt->execute([$username, $email, $hashed_password, $user_id])) {
                $success = 'Profile updated successfully!';
            } else {
                $error = 'Failed to update profile. Please try again.';
            }
        } else {
            // Update without changing the password
            $updateStmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            if ($updateStmt->execute([$username, $email, $user_id])) {
                $success = 'Profile updated successfully!';
            } else {
                $error = 'Failed to update profile. Please try again.';
            }
        }
    }
}

// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - AgriConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Include navigation (adjust path as necessary) -->
  <?php include 'nav.php'; ?>

  <div class="container my-5">
    <h1 class="mb-4">My Profile</h1>
    
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <div class="card">
      <div class="card-header">
        <h2>Profile Details</h2>
      </div>
      <div class="card-body">
        <form action="profile.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input 
              type="text" 
              class="form-control" 
              id="username" 
              name="username" 
              value="<?php echo htmlspecialchars($user['username']); ?>" 
              required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
              type="email" 
              class="form-control" 
              id="email" 
              name="email" 
              value="<?php echo htmlspecialchars($user['email']); ?>" 
              required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">
              New Password (leave blank to keep current password)
            </label>
            <input 
              type="password" 
              class="form-control" 
              id="password" 
              name="password">
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm New Password</label>
            <input 
              type="password" 
              class="form-control" 
              id="confirm_password" 
              name="confirm_password">
          </div>
          <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
