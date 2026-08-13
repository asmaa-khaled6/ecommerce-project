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

                <a href="#" class="btn shop-btn">
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
  



  <?php
include('./shared/close.php');


?>
