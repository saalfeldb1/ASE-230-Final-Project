<?php
$title = 'Admin Page';
require_once 'header.php';

if (isset($_SESSION['username'])&&$_SESSION['usertype']=='admin'){
    ?>
    
<body>
<h1>Product List</h1>

<?php
// Create a PDO connection
$host = 'localhost';
$dbname = 'final_project';
$user = 'root';
$password = '';

if(!isset($_SESSION["username"])){
    header("location:index.php");   
}


    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve products from the database
    $stmt = $pdo->query("SELECT * FROM products");

    if ($stmt->rowCount() > 0) { ?>

<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: lightgrey;
        }
    </style>

        <table>
            <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Action</th>
        <th>Action</th>
        </tr>

<?php
        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $product['productID'] . '</td>';
            echo '<td>' . $product['Name'] . '</td>';
            echo '<td>$' . $product['Price'] . '</td>';
            echo '<td>' . $product['Description'] . '</td>';
            echo '<td><a href="delete_product.php?id=' . $product['productID'] . '" class="edit-button">Delete</a></td>';
            echo '<td><a href="editproduct.php?id=' . $product['productID'] . '" class="edit-button">Edit</a></td>';
            echo '</tr>';
      }

        echo '</table>';
    } else {
        echo 'No products found.';
    }

?>

</body>
</html>

    <?php
}
// Function to delete a product by ID

else{
    header("Location: index.php");
}
?>
