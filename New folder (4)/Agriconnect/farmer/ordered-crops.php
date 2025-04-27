<style>
    /* Order Card Styling */
.order-card {
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Card Header */
.order-card .card-header {
  padding: 0.75rem 1.25rem;
}

/* Card Body */
.order-card .card-body {
  padding: 1.25rem;
}

/* Card Footer */
.order-card .card-footer {
  padding: 0.75rem 1.25rem;
}/* Horizontal Order Card Styling */
.order-card.horizontal-card {
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-card.horizontal-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Adjust card body padding and text styling */
.order-card.horizontal-card .card-body {
  padding: 1rem;
}

.order-card.horizontal-card .card-title {
  font-size: 1.25rem;
  font-weight: bold;
}

.order-card.horizontal-card .card-text {
  font-size: 0.9rem;
}

/* Card footer styling */
.order-card.horizontal-card .card-footer {
  padding: 0.75rem 1rem;
}

/* Left icon section background */
.order-card.horizontal-card .bg-light {
  background-color: #f1f1f1;
}


</style>


<div class="my-4">
  <h2>Ordered Crops</h2>
  <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
    <?php if ($orders): ?>
      <?php foreach ($orders as $order): ?>
        <div class="col">
          <div class="card order-card horizontal-card shadow-sm border-0">
            <div class="row g-0">
              <!-- Left Section: Icon or Thumbnail -->
              <div class="col-4 d-flex align-items-center justify-content-center bg-light">
                <!-- Using a basket icon as a placeholder -->
                <i class="bi bi-basket3-fill text-primary" style="font-size: 2.5rem;"></i>
              </div>
              <!-- Right Section: Order Details -->
              <div class="col-8">
                <div class="card-body">
                  <h5 class="card-title text-primary"><?php echo htmlspecialchars($order['crop_name']); ?></h5>
                  <p class="card-text mb-1">
                    <small class="text-muted">Order Date: <?php echo htmlspecialchars($order['order_date']); ?></small>
                  </p>
                  <p class="card-text">
                    <strong>Buyer:</strong> <?php echo htmlspecialchars($order['buyer_name']); ?><br>
                    <strong>Quantity:</strong> <?php echo htmlspecialchars($order['quantity']); ?><br>
                    <strong>Total Price:</strong> $<?php echo htmlspecialchars($order['total_price']); ?>
                  </p>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-end">
                  <a href="order-details.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-secondary">View Order</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col">
        <div class="alert alert-info text-center" role="alert">
          No orders have been placed on your crops yet.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

