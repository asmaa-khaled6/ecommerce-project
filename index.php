<?php
include('./shared/database.php');
include('./shared/open.php');

include('./shared/nav.php');
//get num of category
$categoryquery="SELECT count(*) AS total From categories";
$allcategory=mysqli_query($conn,$categoryquery);

$row = mysqli_fetch_assoc($allcategory);
$categoryCount = $row['total'];
//get num of product
$productquery="SELECT count(*) AS total From products";
$allproduct=mysqli_query($conn,$productquery);

$row = mysqli_fetch_assoc($allproduct);
$productCount = $row['total'];

//get num of product

$clientquery="SELECT count(*) AS total From clients";
$allclient=mysqli_query($conn,$clientquery);

$row = mysqli_fetch_assoc($allclient);
$clientCount = $row['total'];


// Get all categories
$categoryCardsQuery = "SELECT * FROM categories";
$categoryCards = mysqli_query($conn, $categoryCardsQuery);

// Get all products
$productCardsQuery = "SELECT * FROM products";
$productCards = mysqli_query($conn, $productCardsQuery);

?>

<link rel="stylesheet" href="./css/style.css">
<section class="welcome-section" style="background-color:#F5F6FA !important;">

    <div class="container">

        <div class="row align-items-center">

            <!-- Welcome -->
            <div class="col-lg-6">

                <p class="welcome-subtitle">
                    WELCOME TO OUR STORE
                </p>

                <h1>
                    Discover Amazingg
                    <span>Products</span>
                </h1>

                <p class="welcome-text">
                    Find everything you need in one place.
                    Shop our latest products with the best prices.
                </p>

                <a href="/nti/FinalProject/ecommerce-project/products/list.php" class="btn shop-btn">
                    Shop Now
                    <i class="bi bi-arrow-right"></i>
                </a>


                <!-- Statistics -->
                <div class="row stats-row mt-5">

                    <!-- Categories -->
                    <div class="col-4">

                        <div class="stat-card">

                            <i class="bi bi-grid stat-icon"></i>

                            <h3>
                                <?php echo $categoryCount; ?>
                            </h3>

                            <p>Categories</p>

                        </div>

                    </div>


                    <!-- Products -->
                    <div class="col-4">

                        <div class="stat-card">

                            <i class="bi bi-box-seam stat-icon"></i>

                            <h3>
                                <?php echo $productCount; ?>
                            </h3>

                            <p>Products</p>

                        </div>

                    </div>


                    <!-- Clients -->
                    <div class="col-4">

                        <div class="stat-card">

                            <i class="bi bi-people stat-icon"></i>

                            <h3>
                                <?php echo $clientCount; ?>
                            </h3>

                            <p>Clients</p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Image -->
            <div class="col-lg-6 text-center">

                <img src="./images/home.png"
                     alt="Store"
                     class="welcome-image img-fluid">

            </div>

        </div>

    </div>

</section>



  <!-- Categories Section -->

<section class="py-5">

    <div class="container">

        <div class="text-center mb-4">
            <h2 style="color: #2F8FEF;">Categories</h2>
            <p class="text-secondary">
                Explore our categories
            </p>
        </div>

        <div class="row g-4">

            <?php foreach($categoryCards as $category){ ?>

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="card h-100 border-0 shadow-sm">

                        <img
                            src="./images/categories/<?php echo $category['image']; ?>"
                            class="card-img-top"
                            alt="<?php echo $category['name']; ?>"
                           style="width: 100%; height: 220px; object-fit: cover;"
                        >

                        <div class="card-body text-center">

                            <h5 class="card-title">
                                <?php echo $category['name']; ?>
                            </h5>
                             <a href="/nti/FinalProject/ecommerce-project/categories/list.php" class="btn btn-primary mt-2">
                                  View Category
                                   </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>


<!-- Products Section -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-4">

            <h2 style="color: #2F8FEF;">Products</h2>

            <p class="text-secondary">
                Discover our latest products
            </p>

        </div>

        <div class="row g-4">

            <?php foreach($productCards as $product){ ?>

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="card h-100 border-0 shadow-sm">

                        <img
                            src="./images/products/<?php echo $product['image']; ?>"
                            class="card-img-top"
                            alt="<?php echo $product['name']; ?>"
                            style="width: 100%; height: 220px; object-fit: cover;"
                        >

                        <div class="card-body text-center">

                            <h5 class="card-title">
                                <?php echo $product['name']; ?>
                            </h5>

                            <p class="text-primary fw-bold mb-0">
                                <?php echo $product['price']; ?> EGP
                            </p>

                            <a href="/nti/FinalProject/ecommerce-project/products/list.php"
       class="btn btn-primary">
        <i class="bi bi-eye"></i>
        View Product
    </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>



  <?php
include('./shared/close.php');


?>