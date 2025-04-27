<?php
// admin/navbar.php
if (!isset($_SESSION)) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Optional: Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
  /* Custom Admin Navbar Light Theme Styles */
  .admin-navbar {
    background-color: #f8f9fa; /* light background */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  }
  .admin-navbar .navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
    color: #343a40; /* dark text */
  }
  .admin-navbar .nav-link {
    font-size: 1.1rem;
    color: #6c757d;
    transition: color 0.3s ease;
  }
  .admin-navbar .nav-link:hover,
  .admin-navbar .nav-link.active {
    color: #343a40;
    font-weight: bold;
  }
  .admin-navbar .navbar-toggler {
    border-color: rgba(0, 0, 0, 0.1);
  }
  .admin-navbar .navbar-toggler-icon {
    filter: invert(0);
  }
</style>

<nav class="navbar navbar-expand-lg admin-navbar navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <i class="bi bi-speedometer2 me-2"></i>AgriConnect Admin
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'users.php') ? 'active' : ''; ?>" href="users.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'crops.php') ? 'active' : ''; ?>" href="crops.php">Crops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>" href="orders.php">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
