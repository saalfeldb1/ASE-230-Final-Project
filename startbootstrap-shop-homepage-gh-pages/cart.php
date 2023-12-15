<?php
    require_once 'header.php';

    if (isset($_SESSION['username'])) {
        // Include database connection and other necessary files
    
        // Get product ID from the form submission
        if (isset($_POST['product_id'])) {
            $productID = $_POST['product_id'];
    
            // Fetch user details from the database
            $stmtUser = $pdo->prepare("SELECT ID FROM users WHERE username = :username");
            $stmtUser->bindParam(':username', $_SESSION['username']);
            $stmtUser->execute();
            $userData = $stmtUser->fetch(PDO::FETCH_ASSOC);
    
            if ($userData !== false) { // Check if $userData is not false
                $userID = $userData['ID'];
    
                // Check if the product is already in the user's cart
                $checkStmt = $pdo->prepare("SELECT * FROM orders_products WHERE order_ID = :user_id AND product_ID = :product_id");
                $checkStmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
                $checkStmt->bindParam(':product_id', $productID, PDO::PARAM_INT);
                $checkStmt->execute();
                $existingProduct = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
                if ($existingProduct) {
                    // If the product is already in the cart, update the quantity
                    $updateStmt = $pdo->prepare("UPDATE orders_products SET quantity = quantity + 1 WHERE order_ID = :user_id AND product_ID = :product_id");
                    $updateStmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
                    $updateStmt->bindParam(':product_id', $productID, PDO::PARAM_INT);
    
                    if ($updateStmt->execute()) {
                        echo 'Product quantity updated successfully.';
                    } else {
                        echo 'Failed to update the product quantity.';
                        print_r($updateStmt->errorInfo()); // Print detailed error information
                    }
                } else {
                    // If the product is not in the cart, insert a new row
                    $insertStmt = $pdo->prepare("INSERT INTO orders_products (order_ID, product_ID, quantity) VALUES (:user_id, :product_id, 1)");
                    $insertStmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
                    $insertStmt->bindParam(':product_id', $productID, PDO::PARAM_INT);
    
                    if ($insertStmt->execute()) {
                        echo 'Product added to the cart successfully.';
                    } else {
                        echo 'Failed to add the product to the cart.';
                        print_r($insertStmt->errorInfo()); // Print detailed error information
                    }
                }
            } else {
                echo 'User not found.';
            }
        } else {
            echo 'Product ID is missing in the form submission.';
        }
    } else {
        echo 'User not signed in. Please sign in to add items to your cart.';
    }
    header('location:viewcart.php');
?>
