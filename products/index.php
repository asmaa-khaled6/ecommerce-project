<?php

include('../shared/database.php');

/* Get all products with their categories */

$productQuery = "
    SELECT 
        products.*,
        categories.name AS category_name
    FROM products
    LEFT JOIN categories
        ON products.category_id = categories.id
    ORDER BY products.id DESC
";

$products = mysqli_query($conn, $productQuery);

?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>


<section class="products-section py-5">

    <div class="container">

        <!-- Page Heading -->

        <div class="text-center mb-5">

            <p class="products-subtitle">
                OUR PRODUCTS
            </p>

            <h1 class="products-title">
                Discover Our Products
            </h1>

            <p class="products-text">
                Find something you love from our collection.
            </p>

        </div>


        <!-- Products -->

        <div class="row g-4">

            <?php foreach($products as $product){ ?>

                <div class="col-lg-4 col-md-6">

                    <div class="product-card"
                     style="
                     width: 100%;
                     overflow: hidden;
                     background-color: #FFFFFF;
                    border-radius: 15px;
                    " 
                    >


                        <!-- Product Image -->

                        <div class="product-image" style="
                             width: 100%;
                             height: 250px;
                             overflow: hidden;
                             ">

                            <img
                                src="../images/products/<?php echo $product['image']; ?>"
                                alt="<?php echo $product['name']; ?>"
                                style="
                                width: 100%;
                                height: 250px;
                                object-fit: cover;
                                display: block;
                                "
                            >

                        </div>


                        <!-- Product Information -->

                        <div class="product-card-body">

                            <p class="product-category">

                                <?php echo $product['category_name']; ?>

                            </p>


                            <h4 class="product-name">

                                <?php echo $product['name']; ?>

                            </h4>


                            <!-- Rating -->

                            <div class="product-rating">

                                <?php

                                $rating = $product['rating'];

                                for($i = 1; $i <= 5; $i++){

                                    if($i <= $rating){

                                        echo '<i class="bi bi-star-fill"></i>';

                                    }else{

                                        echo '<i class="bi bi-star"></i>';

                                    }

                                }

                                ?>

                            </div>


                            <!-- Price -->

                            <div class="product-bottom">

                                <span class="product-price">

                                    $<?php echo $product['price']; ?>

                                </span>


                                <a
                                    href="details.php?id=<?php echo $product['id']; ?>"
                                    class="product-view-btn"
                                >

                                    View

                                    <i class="bi bi-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>


<?php
include('../shared/close.php');
?>