<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Create a PDO connection
        $host = 'localhost';
        $dbname = 'final_project';
        $user = 'root';
        $password = '';

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Generate a unique filename
        $uploadsDirectory = "uploads/";
        $originalFilename = basename($_FILES["picture"]["name"]);
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        $uniqueFilename = uniqid('product_') . '_' . time() . '.' . $extension;
        $targetFile = "uploads/". $uniqueFilename;

        // Upload the file
        $tempFile = $_FILES["picture"]["tmp_name"];
        move_uploaded_file($tempFile, $targetFile);

        // Insert new product into the database
        $stmt = $pdo->prepare("INSERT INTO products (Name, Price, Image, Description, userID) VALUES (:name, :price, :picture, :description, :userID)");
        $stmt->bindParam(':name', $_POST["name"]);
        $stmt->bindParam(':price', $_POST["price"]);
        $stmt->bindParam(':picture', $uniqueFilename); // Save the unique filename in the database
        $stmt->bindParam(':description', $_POST["description"]);
        $stmt->bindParam(':userID', $_POST["userID"]);
        $stmt->execute();

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
        <!-- Other form fields -->
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>

        <label for="picture">Product Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/*" required>

        <label for="description">Product Description:</label>
        <textarea id="description" name="description" rows="6" required></textarea><br>

        <!-- Hidden field for user's ID -->
        <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">

        <input type="submit" value="Add Product">
    </form>
    <h2><a href="index.php" style="text-decoration: none; color: black">Go Back</a></h2>
</body>

</html>
