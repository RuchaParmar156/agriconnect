<?php
// nav.php
?>
<!-- Custom Styles for Farmer Navbar -->
<style>
  .navbar-custom {
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .navbar-custom .navbar-brand {
    font-weight: bold;
    color: #007bff;
  }
  .navbar-custom .nav-link {
    font-size: 1rem;
    transition: color 0.3s ease;
    color: #6c757d;
  }
  .navbar-custom .nav-link:hover {
    color: #0056b3;
  }
  .navbar-custom .nav-link.active {
    border-bottom: 2px solid #007bff;
    color: #007bff;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="farmer-dashboard.php">AgriConnect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFarmer" aria-controls="navbarFarmer" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarFarmer">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='farmer-dashboard.php') echo 'active'; ?>" href="farmer-dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='my-crops.php') echo 'active'; ?>" href="my-crops.php">My Crops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='orders.php') echo 'active'; ?>" href="orders.php">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='analytics.php') echo 'active'; ?>" href="analytics.php">Analytics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='profile.php') echo 'active'; ?>" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
