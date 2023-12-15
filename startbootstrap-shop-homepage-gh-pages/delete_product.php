<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    try {
        // Create a PDO connection
        $host = 'localhost';
        $dbname = 'final_project';
        $user = 'root';
        $password = '';

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the DELETE query
        $stmt = $pdo->prepare("DELETE FROM products WHERE productID = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();

        echo 'Product deleted successfully.';

        header('location:userproducts.php');
        if ($_SESSION['usertype']='admin'){
            header('location:admin.php');
        }
       
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Are you sure you want to delete your product?';
}
?>
<!-- Replace your existing form with this -->
<form method="POST" action="delete_product.php">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <button type="submit">Delete Product</button>
</form>
