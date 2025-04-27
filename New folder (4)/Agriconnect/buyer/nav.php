<?php
// nav.php

// Start the session if not already started.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the current page to highlight the active navigation link.
$current_page = basename($_SERVER['PHP_SELF']);

// Define navigation items (adjust links as needed).
$nav_items = [
    'buyer-dashboard.php' => 'Dashboard',
    'orders.php'          => 'Orders',
    'profile.php'         => 'Profile',
    '../logout.php'          => 'Logout'
];
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">AgriConnect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Search Bar -->
    <form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Search crops..." aria-label="Search" required>
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php foreach ($nav_items as $file => $title): ?>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current_page === $file) ? 'active fw-bold' : ''; ?>" href="<?php echo $file; ?>">
              <?php echo $title; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Optional inline CSS for custom styling -->
<style>
  .navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
  }
  .nav-link.active {
    color: #0d6efd !important;
    border-bottom: 2px solid #0d6efd;
  }
</style>
