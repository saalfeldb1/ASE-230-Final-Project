<?php 
$title='Homepage';
require_once 'header.php';
?>


<!-- Header -->
<header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Welcome <?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; ?></h1>
                <p class="lead fw-normal text-white-50 mb-0">Browse our new shop!</p>
            </div>
        </div>
    </header>


    <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php
          

            // Fetch products from the database
            $stmt = $pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are products to display
            if (!empty($products)) {
                foreach ($products as $product) {
            ?>
                    <!-- Display product information -->
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="uploads/<?php echo $product['Image']; ?>" alt="<?php echo $product['Name']; ?>">
                            <div class="card-body p-4">
                                <h5 class="card-title"><?php echo $product['Name']; ?></h5>
                                <p class="card-text"><?php echo $product['Description']; ?></p>
                                <div class="text-center">
                                    $<?php echo $product['Price']; ?>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="details.php?id=<?= $product['productID']?>">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products available.";
            }
            ?>
        </div>
    </div>
    
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
    