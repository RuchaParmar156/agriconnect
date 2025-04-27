<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a farmer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: ../login.php");
    exit;
}

$farmer_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: farmer-dashboard.php");
    exit;
}

$crop_id = $_GET['id'];

// Fetch the crop record that belongs to the logged-in farmer
$stmt = $pdo->prepare("SELECT * FROM crops WHERE id = ? AND farmer_id = ?");
$stmt->execute([$crop_id, $farmer_id]);
$crop = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$crop) {
    $_SESSION['error'] = "Crop not found or you are not authorized to edit it.";
    header("Location: farmer-dashboard.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $name        = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price       = trim($_POST['price']);
    $quantity    = trim($_POST['quantity']);
    $available   = isset($_POST['available']) ? 1 : 0;

    // Basic validation for required fields
    if (empty($name) || empty($price) || empty($quantity)) {
        $error = "Please fill in all required fields (Crop Name, Price, Quantity).";
    } else {
        // Update the crop record
        $stmt = $pdo->prepare("UPDATE crops SET name = ?, description = ?, price = ?, quantity = ?, available = ? WHERE id = ? AND farmer_id = ?");
        if ($stmt->execute([$name, $description, $price, $quantity, $available, $crop_id, $farmer_id])) {
            $success = "Crop updated successfully.";
            // Refresh the crop data after update
            $stmt = $pdo->prepare("SELECT * FROM crops WHERE id = ? AND farmer_id = ?");
            $stmt->execute([$crop_id, $farmer_id]);
            $crop = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $error = "Failed to update crop. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Crop - AgriConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>

    <!-- Edit Crop Form -->
    <div class="container mt-4">
        <h1>Edit Crop</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        <form action="edit-crop.php?id=<?php echo htmlspecialchars($crop_id); ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Crop Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter crop name" value="<?php echo htmlspecialchars($crop['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Crop Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter crop description"><?php echo htmlspecialchars($crop['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price per unit <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php echo htmlspecialchars($crop['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Available Quantity <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" value="<?php echo htmlspecialchars($crop['quantity']); ?>" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="available" name="available" <?php echo $crop['available'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="available">Available</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Crop</button>
            <a href="farmer-dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
