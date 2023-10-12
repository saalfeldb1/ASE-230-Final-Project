<?php
$products = [];

for ($i = 0; $i < 20; $i++) {
    $product = [
        "id" => bin2hex(random_bytes(6)), // Generate a random 12-character ID
        "name" => "Product " . ($i + 1),
        "price" => rand(10, 100), // Generate a random price between 10 and 100
        "picture" => "product" . ($i + 1) . ".jpg", // Assume image file names follow this pattern
        "description" => "Random description for Product " . ($i + 1),
    ];

    $products[] = $product;
}

$productData = ["products" => $products];

file_put_contents("products.json", json_encode($productData, JSON_PRETTY_PRINT));
