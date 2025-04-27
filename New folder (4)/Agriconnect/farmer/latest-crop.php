
<style>
    /* Container for centering and limiting card width */
.latest-crop-container {
  max-width: 650px;
  margin: 0 auto;
}

/* Modern card design */
.latest-crop-card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect: lift card and add shadow */
.latest-crop-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Header overlay styling */
.header-overlay {
  top: 0;
  left: 0;
}

/* Crop title styling */
.crop-title {
  font-size: 1.75rem;
  font-weight: 700;
}

/* Card body styling */
.latest-crop-card .card-body {
  background-color: #fff;
  padding: 1.75rem;
}

/* Row details: add subtle borders between columns */
.latest-crop-card .row > .col {
  padding: 0.5rem 0;
}

.latest-crop-card .row > .col:not(:last-child) {
  border-right: 1px solid #dee2e6;
}

/* Card footer styling */
.latest-crop-card .card-footer {
  background-color: #f8f9fa;
  padding: 1rem 1.5rem;
}

/* Container centering and max width */
.latest-crop-container {
  max-width: 650px;
  margin: 0 auto;
}

/* Modern card design */
.latest-crop-card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect: lift card and add shadow */
.latest-crop-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Header overlay styling */
.header-overlay {
  top: 0;
  left: 0;
}

/* Sold Out badge styling */
.sold-out-badge {
  font-weight: bold;
}

/* Crop title styling */
.crop-title {
  font-size: 1.75rem;
  font-weight: 700;
}

/* Card body styling */
.latest-crop-card .card-body {
  background-color: #fff;
  padding: 1.75rem;
}

/* Row details: add subtle borders between columns */
.latest-crop-card .row > .col {
  padding: 0.5rem 0;
}

.latest-crop-card .row > .col:not(:last-child) {
  border-right: 1px solid #dee2e6;
}

/* Card footer styling */
.latest-crop-card .card-footer {
  background-color: #f8f9fa;
  padding: 1rem 1.5rem;
}
/* Container centering and max width for Latest Crop */
.latest-crop-container {
  max-width: 100%;
  margin: 0 auto;
}

/* Latest Crop Card Styling */
.latest-crop-card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.latest-crop-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.header-overlay {
  position: absolute;
  top: 0;
  left: 0;
}

.crop-title {
  font-size: 1.75rem;
  font-weight: 700;
}

/* Other Crop Card Styling */
.card.mb-3 {
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card.mb-3:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

/* Additional Styling for Rows in Cards */
.latest-crop-card .row > .col {
  padding: 0.5rem 0;
}

.latest-crop-card .row > .col:not(:last-child) {
  border-right: 1px solid #dee2e6;
}

/* Card Footer Styling */
.latest-crop-card .card-footer,
.card.mb-3 .card-footer {
  background-color: #f8f9fa;
  padding: 1rem 1.5rem;
}

/* Sold Out Badge Styling */
.sold-out-badge {
  font-weight: bold;
}
/* Other Crops Card Styling */
.card-other-crop {
  border-radius: 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-other-crop:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Remove default borders from list groups if needed */
.card-other-crop .list-group-item {
  border: none;
}

/* Adjust spacing for row details */
.card-other-crop .row > .col {
  padding: 0.5rem 0;
}

.card-other-crop .row > .col:not(:last-child) {
  border-right: 1px solid #dee2e6;
}

</style>


<div class="container my-5">
  <div class="row">
    <!-- Latest Crop Card on the Left Column -->
    <div class="col-md-8">
      <?php if (!empty($crops)): ?>
        <?php 
          // Assuming $crops is sorted chronologically, the latest is the last element.
          $latestCrop = end($crops);
        ?>
        <div class="card latest-crop-card shadow-lg">
          <!-- Header with background image and overlay -->
          <div class="card-header p-0 position-relative overflow-hidden" style="height: 220px; background: url('assets/images/crop-placeholder.jpg') center/cover no-repeat;">
            <div class="header-overlay position-absolute w-100 h-100 d-flex align-items-end" style="background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.7) 100%);">
              <h3 class="crop-title m-0 p-3 text-white">Latest: <?php echo htmlspecialchars($latestCrop['name']); ?></h3>
            </div>
            <?php if (!$latestCrop['available']): ?>
              <span class="badge bg-danger sold-out-badge position-absolute" style="top: 10px; right: 10px; font-size: 1rem;">Sold Out</span>
            <?php endif; ?>
          </div>
          <!-- Crop Details -->
          <div class="card-body">
            <p class="card-text mb-4"><?php echo htmlspecialchars($latestCrop['description']); ?></p>
            <div class="row text-center">
              <div class="col border-end">
                <small class="text-muted"><strong>Price</strong><br>$<?php echo htmlspecialchars($latestCrop['price']); ?></small>
              </div>
              <div class="col border-end">
                <small class="text-muted"><strong>Quantity</strong><br><?php echo htmlspecialchars($latestCrop['quantity']); ?></small>
              </div>
              <div class="col">
                <small class="text-muted"><strong>Available</strong><br><?php echo $latestCrop['available'] ? 'Yes' : 'No'; ?></small>
              </div>
            </div>
          </div>
          <!-- Action Buttons -->
          <div class="card-footer d-flex justify-content-end bg-light">
            <a href="edit-crop.php?id=<?php echo $latestCrop['id']; ?>" class="btn btn-primary btn-sm me-2">Edit</a>
            <!-- <a href="delete-crop.php?id=<?php echo $latestCrop['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this crop?');">Delete</a> -->
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
          No crops found. Please add a new crop.
        </div>
      <?php endif; ?>
    </div>

    <!-- Other Two Crop Cards and a "View All Crops" Button on the Right Column -->
    <div class="col-md-4">
  <h4 class="mb-3">Other Crops</h4>
  <?php 
    // Extract two other crops (if available)
    $otherCrops = [];
    if (!empty($crops)) {
      $totalCrops = count($crops);
      if ($totalCrops >= 3) {
        // Get the last 3 items and remove the latest crop.
        $otherCrops = array_slice($crops, -3, 3);
        array_pop($otherCrops);
      } else {
        $otherCrops = $crops;
        if (!empty($crops)) array_pop($otherCrops);
      }
    }
  ?>
  <?php if (!empty($otherCrops)): ?>
    <?php foreach ($otherCrops as $crop): ?>
      <div class="card card-other-crop mb-3 shadow-sm border-0">
        <div class="card-body p-3">
          <h5 class="card-title text-primary mb-2"><?php echo htmlspecialchars($crop['name']); ?></h5>
          <p class="card-text text-muted mb-3"><?php echo htmlspecialchars($crop['description']); ?></p>
          <div class="row text-center">
            <div class="col border-end">
              <small><strong>Price:</strong> $<?php echo htmlspecialchars($crop['price']); ?></small>
            </div>
            <div class="col border-end">
              <small><strong>Qty:</strong> <?php echo htmlspecialchars($crop['quantity']); ?></small>
            </div>
            <div class="col">
              <small><strong>Available:</strong> <?php echo $crop['available'] ? 'Yes' : 'No'; ?></small>
            </div>
          </div>
        </div>
        <div class="card-footer bg-transparent border-0 text-end px-3 pb-2">
          <a href="edit-crop.php?id=<?php echo $crop['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-info text-center" role="alert">
      No other crops found.
    </div>
  <?php endif; ?>
  <div class="text-center mt-3">
    <a href="my-crops.php" class="btn btn-outline-secondary">View All Crops</a>
  </div>
</div>

  </div>
</div>
