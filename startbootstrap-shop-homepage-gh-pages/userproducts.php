<?php
$title = 'User Products';
require_once 'header.php';

// Include your database connection code here
$host = 'localhost';
$dbname = 'final_project';
$user = 'root';
$password = '';

// Create a PDO connection
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the user is signed in

if (!isset($_SESSION['userID'])) {
    echo 'User not signed in. Please sign in to view your products.';
    exit;
}

// Retrieve all products associated with the user
$userID = $_SESSION['userID'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE userID = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Products</title>
</head>

<body>
    <h1>User Products</h1>

    <?php if (count($products) > 0): ?>

        <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: lightgrey;
        }
    </style>

        <table>
            
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
                <th>Action</th>

                
                <!-- Add more columns as needed -->
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>

                    <td><?= $product['Name'] ?></td>
                    <td><?= $product['Price'] ?></td>
                    <td><?= $product['Description'] ?></td>
                    <td><a href="editproduct.php?id=<?= $product['productID'] ?>" class="edit-button">Edit</a></td>
                    <td><a href="delete_product.php?id=<?= $product['productID'] ?>" class="delete-button">Delete</a></td>

                    
                    <!-- Add more cells as needed -->
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No products found for this user.</p>
    <?php endif; ?>

</body>

</html>
