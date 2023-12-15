<?php
// Include your database connection code here
$host = 'localhost';
$dbname = 'final_project';
$user = 'root';
$password = '';

// Create a PDO connection
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if a new file is uploaded
    if ($_FILES["picture"]["size"] > 0) {
        // Upload the file
      // Check if a new file is uploaded
        if ($_FILES["picture"]["size"] > 0) {
            // Use the original filename to overwrite the existing file
            $uploadsDirectory = "uploads/";
            $originalFilename = basename($_FILES["picture"]["name"]);
            $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $uniqueFilename = uniqid('product_') . '_' . time() . '.' . $extension;
            $targetFile = $uploadsDirectory . $uniqueFilename;


            // Upload the file
            $tempFile = $_FILES["picture"]["tmp_name"];
            move_uploaded_file($tempFile, $targetFile);
        } else {
            // No new file uploaded, keep the existing file path
            $targetFile = $_POST["existing_picture"];
        }
    

   

    // Update the product in the database
    $stmt = $pdo->prepare("UPDATE products SET Name = :name, Price = :price, Image = :picture, Description = :description WHERE ProductID = :id");
    $stmt->bindParam(':name', $_POST["name"]);
    $stmt->bindParam(':price', $_POST["price"]);
    $stmt->bindParam(':picture', $uniqueFilename);
    $stmt->bindParam(':description', $_POST["description"]);
    $stmt->bindParam(':id', $_POST["product_id"]); 
    $stmt->execute();

    header("Location: index.php"); // Redirect back to homepage
    exit;
    }
}

// Check if a product ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the product details from the database
    $productID = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE ProductID = :id");
    $stmt->bindParam(':id', $productID);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo 'Product not found.';
        exit;
    }
} else {
    echo 'Product ID is missing in the URL.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="custom.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>
    <h1>Edit Product</h1>
    <form action="editproduct.php" method="post" enctype="multipart/form-data">
        <!-- Hidden input for product_id -->
        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
        <!-- Hidden input to store existing picture path -->
        <input type="hidden" name="existing_picture" value="<?php echo $product['Image']; ?>">

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['Name']; ?>" required>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $product['Price']; ?>" required>

        <label for="picture">Product Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/*">

        <label for="description">Product Description:</label>
        <textarea id="description" name="description" rows="6"><?php echo $product['Description']; ?></textarea><br>

        <input type="submit" value="Update Product">
    </form>
    <h2><a href="userproducts.php" style="text-decoration: none; color: black">Go Back</a></h2>
</body>

</html>
