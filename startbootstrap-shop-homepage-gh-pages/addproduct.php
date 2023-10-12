
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    
    if (isset($_FILES["picture"])) {
        $uploadsDirectory = "uploads/"; // Destination directory
        $tempFile = $_FILES["picture"]["tmp_name"]; // Temporary file location
        $targetFile = $uploadsDirectory . basename($_FILES["picture"]["name"]); // Target location

        move_uploaded_file($tempFile, $targetFile);
    }

    

    $newProduct = [
        "id" => uniqid(),
        "name" => $_POST["name"],
        "price" => ($_POST["price"]),
        "picture" => $targetFile,
        "description" => $_POST["description"]

    ];

    $products = [];
    if (file_exists("Products.json")) {
        $products = json_decode(file_get_contents("Products.json"), true);
    }

    $products["products"][] = $newProduct;

    // Save the updated product data to the JSON file
    file_put_contents("products.json", json_encode($products, JSON_PRETTY_PRINT));

    header("Location: index.php"); // Redirect back to homepage
    exit;
    
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="custom.css" rel="stylesheet" />

    <title>Add Product</title>
    
</head>
<body>
    <h1>Add Item</h1>
    <form action="addproduct.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>

        <label for="picture">Product Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/*" required>

        <label for="description">Product Description:</label>
        <textarea id="description" name="description" rows="6" required></textarea><br>

        <input type="submit" value="Add Product">
    </form>
    <h2><a href="index.php" style="text-decoration: none; color: black">Go Back</a></h2>
</body>
</html>

