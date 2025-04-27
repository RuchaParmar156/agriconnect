<?php
session_start();
require_once 'connection.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize form data
    $username         = trim($_POST['username']);
    $email            = trim($_POST['email']);
    $password         = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role             = trim($_POST['role']);

    // Validate required fields
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!in_array($role, ['farmer', 'buyer'])) {
        $error = "Invalid user role selected.";
    } else {
        try {
            // Check if username already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $error = "This username is already taken. Please choose a different one.";
            } else {
                // Check if email already exists
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->rowCount() > 0) {
                    $error = "An account with this email already exists.";
                } else {
                    // Hash the password and insert the new user
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                    if ($stmt->execute([$username, $email, $hashed_password, $role])) {
                        $success = "Registration successful! You can now <a href='login.php'>login</a>.";
                    } else {
                        $error = "Registration failed. Please try again.";
                    }
                }
            }
        } catch (PDOException $e) {
            $error = "Registration failed. Please try again with different information.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - AgriConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-md-8 col-lg-5">
        <div class="card shadow-sm">
          <div class="card-header text-center bg-success text-white">
            <h2 class="mb-0">Create Your Account</h2>
            <p class="small mb-0">Join AgriConnect to connect directly with buyers and farmers</p>
          </div>
          <div class="card-body">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
              <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST" action="register.php">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <label for="username">Username</label>
                <small class="text-muted">Choose a unique username</small>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email">Email Address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <label for="confirm_password">Confirm Password</label>
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">I am a:</label>
                <select class="form-select" id="role" name="role" required>
                  <option value="" disabled selected>Select your role</option>
                  <option value="farmer">Farmer</option>
                  <option value="buyer">Buyer</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success w-100 py-2">Sign Up</button>
              <div class="text-center mt-3">
                <small>Already have an account? <a href="login.php">Login</a></small>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
