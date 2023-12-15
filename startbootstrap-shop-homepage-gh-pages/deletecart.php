<?php
session_start();

// Create a PDO connection
$host = 'localhost';
$dbname = 'final_project';
$user = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the user is signed in
if (!isset($_SESSION['userID'])) {
    echo 'User not signed in. Please sign in to manage your cart.';
    exit;
}

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Update the database to reflect the removed item
    $userId = $_SESSION['userID'];
    $stmt = $pdo->prepare("DELETE FROM orders_products WHERE order_ID = :userID AND product_ID = :productID");
    $stmt->bindParam(':userID', $userId);
    $stmt->bindParam(':productID', $productId);

    if ($stmt->execute()) {
        // Redirect to viewcart.php after successful deletion
        header("Location: viewcart.php");
        exit;
    } else {
        echo 'Failed to delete the item.';
    }
} else {
    echo 'Product ID is missing in the URL.';
}
?>
