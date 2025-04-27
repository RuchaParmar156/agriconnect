<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a buyer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'buyer') {
    header("Location: ../login.php");
    exit;
}

// Retrieve the search query
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

$crops = [];

if ($searchQuery !== '') {
    // Prepare and execute the search query
    $stmt = $pdo->prepare("
        SELECT crops.*, users.username AS farmer_name 
        FROM crops 
        JOIN users ON crops.farmer_id = users.id 
        WHERE crops.available = 1 AND crops.name LIKE :searchQuery
    ");
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
    $crops = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - AgriConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Include the common navigation bar -->
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>
        <?php if ($crops): ?>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Crop Name</th>
                        <th>Description</th>
                        <th>Price per Unit</th>
                        <th>Quantity</th>
                        <th>Farmer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($crops as $crop): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($crop['name']); ?></td>
                            <td><?php echo htmlspecialchars($crop['description']); ?></td>
                            <td>$<?php echo htmlspecialchars($crop['price']); ?></td>
                            <td><?php echo htmlspecialchars($crop['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($crop['farmer_name']); ?></td>
                            <td>
                                <a href="order-crop.php?id=<?php echo $crop['id']; ?>" class="btn btn-success btn-sm">Buy</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="mt-3">No crops found matching your search criteria.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
