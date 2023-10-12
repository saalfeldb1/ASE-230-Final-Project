<?php
$title = 'Admin Page';
require_once 'header.php';

// Function to delete a product by ID
function deleteProductById($productId, &$products) {
    foreach ($products['products'] as $key => $product) {
        if ($product['id'] === $productId) {
            // Remove the product from the array
            unset($products['products'][$key]);
            return;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
    $jsonString = file_get_contents('products.json');
    $products = json_decode($jsonString, true);

    $productIdToDelete = $_POST['delete_product_id'];
    deleteProductById($productIdToDelete, $products);

    // Save the updated data back to the JSON file
    file_put_contents('products.json', json_encode($products, JSON_PRETTY_PRINT));

    // Redirect back to the admin page after deletion
    header('Location: admin.php');
    exit;
}

?>

<body>
    <h1>Product List</h1>

    <?php
    $jsonString = file_get_contents('products.json');
    $products = json_decode($jsonString, true);

    if ($products && isset($products['products'])) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Price</th>';
        echo '<th>Description</th>';
        echo '<th>Action</th>';
        echo '</tr>';

        foreach ($products['products'] as $product) {
            echo '<tr>';
            echo '<td>' . $product['id'] . '</td>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td>$' . number_format($product['price'], 2) . '</td>';
            echo '<td>' . $product['description'] . '</td>';
            echo '<td>
                    <form method="POST">
                        <input type="hidden" name="delete_product_id" value="' . $product['id'] . '">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                  </td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No products found.';
    }
    ?>

</body>
</html>
