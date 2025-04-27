<?php
session_start();
require_once 'connection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Retrieve user from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Assume passwords are hashed using password_hash()
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'farmer') {
                header("Location: farmer/farmer-dashboard.php");
                exit;
            } elseif ($user['role'] === 'buyer') {
                header("Location: buyer/buyer-dashboard.php");
                exit;
            } else {
                header("Location: admin/index.php");
                exit;
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No user found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - AgriConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <!-- Centered Login Section -->
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-md-8 col-lg-5">
        <div class="card shadow-sm">
          <div class="card-header text-center bg-primary text-white">
            <h2 class="mb-0">Welcome Back</h2>
            <p class="small mb-0">Sign in to your AgriConnect account</p>
          </div>
          <div class="card-body">
            <!-- Display error if available -->
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form id="login-form" method="POST" action="login.php">
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email">Email Address</label>
              </div>
              <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePassword('password')">
                  <i class="far fa-eye"></i>
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me">
                  <label class="form-check-label" for="remember-me">Remember me</label>
                </div>
                <a href="#" id="forgot-password" class="small">Forgot Password?</a>
              </div>
              <button type="submit" class="btn btn-primary w-100 py-2">Sign In</button>
              <div class="text-center mt-3">
                <small>Don't have an account? <a href="register.php">Sign Up</a></small>
              </div>
            </form>
          </div>
        </div>

        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Enter your email address and we'll send you a link to reset your password.</p>
                <div class="form-floating">
                  <input type="email" class="form-control" id="reset-email" name="reset-email" placeholder="Email Address" required>
                  <label for="reset-email">Email Address</label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="send-reset-link">Send Reset Link</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->

      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle and Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome for icons -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script>
    // Toggle password visibility
    function togglePassword(id) {
      const passwordInput = document.getElementById(id);
      const icon = event.currentTarget.querySelector('i');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
    
    // Forgot password modal
    document.getElementById('forgot-password').addEventListener('click', function(e) {
      e.preventDefault();
      const forgotPasswordModal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));
      forgotPasswordModal.show();
    });
    
    // Send reset link action (dummy functionality)
    document.getElementById('send-reset-link').addEventListener('click', function() {
      const email = document.getElementById('reset-email').value;
      if (!email) {
        alert('Please enter your email address');
        return;
      }
      alert('Password reset link sent to ' + email);
      bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal')).hide();
    });
  </script>
</body>
</html>
