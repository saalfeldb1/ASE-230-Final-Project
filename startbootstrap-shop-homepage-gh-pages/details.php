<?php
$title = 'Details';
require_once 'header.php';
?>

<body>
    <?php
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];
        $products = json_decode(file_get_contents('products.json'), true);

        // Find the product with the matching ID
        $product = null;
        foreach ($products['products'] as $p) {
            if ($p['id'] === $productID) {
                $product = $p;
                break;
            }
        }

        if ($product) {
            echo '<div class="product-details">';
            echo '<img src="' . $product['picture'] . '" alt="' . $product['name'] . '" class="product-image" style="max-width: 800px; max-height: 800px;">'; // Add max-width and max-height styles here
            echo '<div class="product-info">';
            echo '<h1 class="product-name">' . $product['name'] . '</h1>';
            echo '<p class="product-price">$' . number_format($product['price'], 2) . '</p>';
            if (isset($product['description'])) {
                echo '<p class="product-description">' . $product['description'] . '</p>';
            }
            echo '<button class="add-to-cart-button">Add to Cart</button>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'Product not found.';
        }
    } else {
        echo 'Product ID is missing in the URL.';
    }

    ?>
</body>
</html>
