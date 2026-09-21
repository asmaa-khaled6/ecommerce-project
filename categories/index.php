<?php

include('../shared/database.php');
include('../shared/open.php');
include('../shared/nav.php');

$categoryquery = "SELECT * FROM categories";
$categories = mysqli_query($conn, $categoryquery);

?>

<link rel="stylesheet" href="../css/style.css">

<section class="categories-section py-5">

    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-5">

            <p class="categories-subtitle">
                EXPLORE OUR STORE
            </p>

            <h1 class="categories-title">
                Shop by Category
            </h1>

            <p class="categories-description">
                Discover products from our wide range of categories.
            </p>

        </div>


        <!-- Categories -->
        <div class="row g-4">

            <?php foreach($categories as $category){ ?>

                <div class="col-12 col-sm-6 col-lg-3">

                    <div class="category-card h-100">

                        <!-- Image -->
                        <div class="category-image">

                            <img
                                src="../images/categories/<?php echo $category['image']; ?>"
                                alt="<?php echo $category['name']; ?>"
                            >

                        </div>


                        <!-- Category Name -->
                        <h4 class="category-card-title">
                            <?php echo $category['name']; ?>
                        </h4>


                        <!-- Description -->
                        <p class="category-card-text">
                            Explore our <?php echo $category['name']; ?> collection.
                        </p>


                        <!-- Button -->
                        <a
                            href="../products/index.php?category=<?php echo $category['id']; ?>"
                            class="category-link"
                        >
                            View Products
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>


<?php
include('../shared/close.php');
?>