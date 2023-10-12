<?php
if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    // Load the products from the JSON file
    $products = json_decode(file_get_contents('Products.json'), true);

    // Find the product with the matching ID
    $productIndex = null;
    foreach ($products['products'] as $key => $product) {
        if ($product['id'] === $productId) {
            $productIndex = $key;
            break;
        }
    }

    if ($productIndex !== null) {
        // Remove the product from the array
        unset($products['products'][$productIndex]);

        // Encode the modified array back to JSON
        $newProductsJson = json_encode($products, JSON_PRETTY_PRINT);

        // Save the updated data back to the JSON file
        file_put_contents('Products.json', $newProductsJson);

        echo 'success';
    } else {
        echo 'Product not found.';
    }
} else {
    echo 'Product ID is missing in the request.';
}
?>
