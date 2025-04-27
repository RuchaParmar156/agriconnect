<style>
/* Crop Card Styling */
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

/* Card Title Styling */
.crop-card .card-title {
  font-size: 1.25rem;
  font-weight: bold;
}

/* Card Footer Styling */
.crop-card .card-footer {
  padding: 0.75rem 1.25rem;
  background-color: #f8f9fa;
}

/* List Group Item Styling */
.crop-card .list-group-item {
  font-size: 0.9rem;
}

</style>
<div class="container mt-4">
  <h1>Welcome, Buyer!</h1>
  <p>Browse available crops and buy fresh produce directly from farmers.</p>
  
  <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    <?php if ($crops): ?>
      <?php foreach ($crops as $crop): ?>
        <div class="col">
          <div class="card h-100 crop-card shadow-sm">
            <!-- Optional Crop Image -->
            <img src="assets/images/crop-placeholder.jpg" class="card-img-top" alt="<?php echo htmlspecialchars($crop['name']); ?>">
            <div class="card-body">
              <h5 class="card-title text-primary"><?php echo htmlspecialchars($crop['name']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($crop['description']); ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Price per Unit:</strong> $<?php echo htmlspecialchars($crop['price']); ?></li>
              <li class="list-group-item"><strong>Quantity:</strong> <?php echo htmlspecialchars($crop['quantity']); ?></li>
              <li class="list-group-item"><strong>Farmer:</strong> <?php echo htmlspecialchars($crop['farmer_name']); ?></li>
            </ul>
            <div class="card-footer text-end bg-light">
              <a href="order-crop.php?id=<?php echo $crop['id']; ?>" class="btn btn-success btn-sm">Buy</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col">
        <div class="alert alert-info text-center" role="alert">
          No crops available at the moment.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
