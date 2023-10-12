<?php 
$title='Homepage';
require_once 'header.php';
print_r($_SESSION);
$firstname='';


?>

<!-- Header -->
<header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Welcome <?=$firstname?>!</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
            </div>
        </div>
    </header>
    <!-- Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                //Read and decode the products.jsn file
                $products=[];
                if(file_exists("products.json")){
                    $products = json_decode(file_get_contents("products.json"),true);
                }

                //See if there are products to display
                if(!empty($products['products'])){

                    foreach($products['products'] as $product){
                    ?>
               
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image -->
                            <img class="card-img-top" src='<?= $product['picture'] ?>' alt="<?= $product['name'] ?>" />
                            <!-- Product details -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name -->
                                    <h5 class="fw-bolder"><?= $product['name'] ?></h5>
                                    <!-- Product price -->
                                    $<?= number_format($product['price'], 2) ?>
                                </div>
                            </div>
                            <!-- Product actions -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="details.php?id=<?= $product['id']?>">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
                ?>

            </div>
        </div>
    </section>
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
