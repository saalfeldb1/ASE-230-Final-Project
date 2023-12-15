<?php
require_once('header.php');


// Check if the user is signed in
if (!isset($_SESSION['userID'])) {
    print_r($_SESSION);
    echo 'User not signed in. Please sign in to view your orders.';
    exit;
}

// Retrieve orders associated with the user
$userID = $_SESSION['userID'];
$stmt = $pdo->prepare("SELECT op.product_ID, op.quantity, p.Name, p.Price FROM orders_products op
                      JOIN products p ON op.product_ID = p.ProductID
                      WHERE op.order_ID = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
</head>

<body>
    <h1>Cart</h1>

    <?php if (count($orders) > 0): ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>View Item</th>
                <th>Delete Item</th>

            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['Name'] ?></td>
                    <td>$<?= $order['Price'] ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><a href="details.php?id=<?= $order['product_ID'] ?>">View Item</a></td>
                    <td><a href="deletecart.php?id=<?= $order['product_ID'] ?>">Delete Item</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No items found for this user.</p>
    <?php endif; ?>

</body>

</html>
