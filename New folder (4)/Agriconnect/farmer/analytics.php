<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in and is a farmer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: ../login.php");
    exit;
}

$farmer_id = $_SESSION['user_id'];

// Fetch sales data for the logged-in farmer
$sales_query = "
    SELECT 
        c.name AS crop_name,
        SUM(o.quantity) AS total_quantity_sold,
        SUM(o.total_price) AS total_sales,
        DATE_FORMAT(o.order_date, '%Y-%m') AS sales_month
    FROM orders o
    JOIN crops c ON o.crop_id = c.id
    WHERE c.farmer_id = ?
    GROUP BY c.name, sales_month
    ORDER BY sales_month DESC
";
$stmt = $pdo->prepare($sales_query);
$stmt->execute([$farmer_id]);
$sales_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for chart visualization
// $chart_data will be keyed by month, then crop name.
$chart_data = [];
foreach ($sales_data as $data) {
    $month = $data['sales_month'];
    $crop  = $data['crop_name'];
    $chart_data[$month][$crop] = [
        'total_quantity_sold' => (int)$data['total_quantity_sold'],
        'total_sales' => (float)$data['total_sales']
    ];
}

// Extract unique crop names across all months.
$all_crop_names = [];
foreach($chart_data as $month => $crops) {
    // array_keys() returns the crop names for this month
    $all_crop_names = array_merge($all_crop_names, array_keys($crops));
}
$crop_names = array_unique($all_crop_names);
sort($crop_names);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Analytics - AgriConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Chart.js and its datalabels plugin -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <style>
      .chart-container {
          position: relative;
          height: 400px;
          width: 100%;
      }
  </style>
</head>
<body>
  <?php include 'nav.php'; ?>
  
  <div class="container mt-4">
      <h1 class="mb-4">Sales Analytics</h1>
      
      <?php if (!empty($chart_data)): ?>
          <?php foreach ($chart_data as $month => $crops): ?>
              <div class="card mb-4">
                  <div class="card-header">
                      <h5 class="card-title mb-0"><?php echo htmlspecialchars($month); ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="chart-container">
                          <canvas id="chart-<?php echo htmlspecialchars($month); ?>"></canvas>
                      </div>
                  </div>
              </div>
              <script>
                  document.addEventListener('DOMContentLoaded', function () {
                      var ctx = document.getElementById('chart-<?php echo htmlspecialchars($month); ?>').getContext('2d');
                      var cropNames = <?php echo json_encode($crop_names); ?>;
                      var quantityData = [];
                      var salesData = [];
                      
                      // Build data arrays for each crop, use 0 if crop not found for this month.
                      cropNames.forEach(function(crop) {
                          if (<?php echo json_encode($crops); ?>.hasOwnProperty(crop)) {
                              quantityData.push(<?php echo json_encode($crops); ?>[crop]['total_quantity_sold']);
                              salesData.push(<?php echo json_encode($crops); ?>[crop]['total_sales']);
                          } else {
                              quantityData.push(0);
                              salesData.push(0);
                          }
                      });
                      
                      new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels: cropNames,
                              datasets: [{
                                  type: 'bar',
                                  label: 'Total Quantity Sold',
                                  data: quantityData,
                                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                  borderColor: 'rgba(75, 192, 192, 1)',
                                  borderWidth: 1,
                                  yAxisID: 'y',
                              },
                              {
                                  type: 'line',
                                  label: 'Total Sales (₹)',
                                  data: salesData,
                                  backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                  borderColor: 'rgba(153, 102, 255, 1)',
                                  borderWidth: 2,
                                  fill: false,
                                  yAxisID: 'y1',
                              }]
                          },
                          options: {
                              responsive: true,
                              plugins: {
                                  legend: {
                                      position: 'top',
                                  },
                                  title: {
                                      display: true,
                                      text: 'Sales Data for <?php echo htmlspecialchars($month); ?>'
                                  },
                                  datalabels: {
                                      anchor: 'end',
                                      align: 'top',
                                      formatter: Math.round,
                                      font: {
                                          weight: 'bold',
                                          size: 12
                                      }
                                  }
                              },
                              scales: {
                                  y: {
                                      beginAtZero: true,
                                      position: 'left',
                                      title: {
                                          display: true,
                                          text: 'Total Quantity Sold'
                                      }
                                  },
                                  y1: {
                                      beginAtZero: true,
                                      position: 'right',
                                      title: {
                                          display: true,
                                          text: 'Total Sales (₹)'
                                      },
                                      grid: {
                                          drawOnChartArea: false
                                      }
                                  }
                              }
                          },
                          plugins: [ChartDataLabels]
                      });
                  });
              </script>
          <?php endforeach; ?>
      <?php else: ?>
          <div class="alert alert-warning" role="alert">
              No sales data available to display.
          </div>
      <?php endif; ?>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
