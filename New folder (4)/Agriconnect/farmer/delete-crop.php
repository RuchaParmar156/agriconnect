<?php
session_start();
require_once '../connection.php';

// Ensure the user is logged in as a farmer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: farmer-dashboard.php");
    exit;
}

$crop_id = $_GET['id'];
$farmer_id = $_SESSION['user_id'];

// Check if the crop belongs to the logged-in farmer
$stmt = $pdo->prepare("SELECT * FROM crops WHERE id = ? AND farmer_id = ?");
$stmt->execute([$crop_id, $farmer_id]);
$crop = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$crop) {
    $_SESSION['error'] = "Crop not found or you are not authorized to delete it.";
    header("Location: farmer-dashboard.php");
    exit;
}

// Delete the crop
$stmt = $pdo->prepare("DELETE FROM crops WHERE id = ?");
if ($stmt->execute([$crop_id])) {
    $_SESSION['success'] = "Crop deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete crop. Please try again.";
}

header("Location: farmer-dashboard.php");
exit;
?>
