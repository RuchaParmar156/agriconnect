<style>
/* Order History Card Styling */
.order-history-card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-history-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.order-history-card .card-header {
  font-size: 1rem;
  font-weight: bold;
  background-color: #f8f9fa;
  padding: 0.75rem 1.25rem;
}

.order-history-card .card-body {
  padding: 1rem 1.25rem;
}

</style>

<div class="container mt-5">
  <h2>Your Order History</h2>
  <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
    <?php if ($orders): ?>
      <?php foreach ($orders as $order): ?>
        <div class="col">
          <div class="card order-history-card shadow-sm">
            <!-- Card Header -->
            <div class="card-header bg-light">
              <strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <h5 class="card-title text-primary"><?php echo htmlspecialchars($order['crop_name']); ?></h5>
              <p class="card-text">
                <strong>Quantity:</strong> <?php echo htmlspecialchars($order['quantity']); ?><br>
                <strong>Total Price:</strong> $<?php echo htmlspecialchars($order['total_price']); ?><br>
                <strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col">
        <div class="alert alert-info text-center" role="alert">
          You have not placed any orders yet.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
