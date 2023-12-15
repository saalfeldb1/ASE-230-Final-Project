<?php
session_start();
$host='localhost';
$db='final_project';
$user='root';
$pass='';
$charset='utf8';

$dsn="mysql:host=$host;dbname=$db;charset=$charset";
$opt=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false,

];

$pdo = new PDO($dsn,$user,$pass,$opt);

$db = new PDO('mysql:host=localhost;dbname=final_project;charset=utf8mb4',
'root', '');

//Update Cart Entity
$userIsSignedIn = isset($_SESSION['username']);
if ($userIsSignedIn) {
    // Get the user ID
    $userId = $_SESSION['userID'];

    // Query the database to get the number of items in the cart for the current user
    $stmt = $pdo->prepare("SELECT COUNT(*) as cartCount FROM orders_products WHERE order_ID = :userID");
    $stmt->bindParam(':userID', $userId);
    $stmt->execute();
    $cartCount = $stmt->fetch()['cartCount'];
} else {
    $cartCount = 0;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" /><style>
            .max-size-image {
                max-width: 300px; /* Set your desired maximum width */
                max-height: 200px; /* Set your desired maximum height */
                width: auto; /* To maintain the aspect ratio */
                height: auto; /* To maintain the aspect ratio */
                }
        </style>
        
    </head>
    <body>
        <!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container px-4 px-lg-5">
        <h5>Handiwork Hub</h5>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                

                <!-- Only show the following links if the user is logged in -->
                <?php
                // Check if the user is signed in
                if (isset($_SESSION['username'])) {
                    echo '<li class="nav-item"><a class="nav-link" href="addproduct.php">Add Product</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="userproducts.php">Edit Product</a></li>';
                }
                ?>

            </ul>
            
            <?php
            
               
               
                // Check if the user is signed in
                if (isset($_SESSION['username'])) {
                    // If signed in, display logout link
                    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">';
                    echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">Logout</a></li>';

                    // Check if the user is an admin
                    if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') {
                        echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="admin.php">Admin Page</a></li>';
                    }

                    echo '</ul>';
                } else {
                    // If not signed in, display sign in and sign up links
                    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">';
                    echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="signin.php">Sign In</a></li>';
                    echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="signup.php">Sign Up</a></li>';
                    echo '</ul>';
                }
                ?>

            <!--Update cart entity-->
                <form class="d-flex" action="<?= $userIsSignedIn ? 'viewcart.php' : '#' ?>" method="post">
                    <button class="btn btn-outline-dark" type="<?= $userIsSignedIn ? 'submit' : 'button' ?>">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <?php if ($userIsSignedIn): ?>
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </button>
                </form>
        </div>
    </div>
</nav>
