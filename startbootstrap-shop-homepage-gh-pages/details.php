<?php
$title = 'Details';
require_once 'header.php';
?>
<style>
    .product-image {
        height: 400px; /* Set your desired height */
        object-fit: cover; /* This property ensures the image covers the entire container */
    }
</style>

<?php

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Fetch the product details from the database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE productID = :id");
    $stmt->bindParam(':id', $productID, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product) {
        ?>
        <div class="product-details">
            <img src="uploads/<?= $product['Image'] ?>" alt="<?= $product['Name'] ?>" class="product-image" style="max-width: 800px; max-height: 800px;">
            <div class="product-info">
                <h1 class="product-name"><?= $product['Name'] ?></h1>
                <p class="product-price">$<?=$product['Price'] ?></p>
                <?php if (isset($product['Description'])): ?>
                    <p class="product-description"><?= $product['Description'] ?></p>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])): ?>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?= $product['productID'] ?>">
                        <input type="submit" class="add-to-cart-button" value="Add to Cart">
                    </form>
                <?php else: ?>
                    <p class="product-description">Sign in to add items to your cart.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    } else {
        echo 'Product not found.';
    }
} else {
    echo 'Product ID is missing in the URL.';
}
?>
