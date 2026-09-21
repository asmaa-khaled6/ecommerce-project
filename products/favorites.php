<?php

session_start();

include('../shared/database.php');

$successmessage = "";
$errormessage = "";


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {

    header("Location: ../auth/login.php");
    exit;

}

$user_id = $_SESSION['user_id'];


// ================= REMOVE FAVORITE =================

if (isset($_GET['remove'])) {

    $product_id = $_GET['remove'];

    $deleteQuery = "DELETE FROM favorites
                    WHERE user_id=$user_id
                    AND product_id=$product_id";

    if (mysqli_query($conn, $deleteQuery)) {

        $successmessage = "Product Removed From Favorites Successfully";

    } else {

        $errormessage = "Failed To Remove Product From Favorites";

    }
}


// ================= GET FAVORITE PRODUCTS =================

$query = "
    SELECT
        products.*,
        categories.name AS category_name
    FROM favorites

    INNER JOIN products
        ON favorites.product_id = products.id

    LEFT JOIN categories
        ON products.category_id = categories.id

    WHERE favorites.user_id = $user_id
";

$result = mysqli_query($conn, $query);

?>

<?php

include('../shared/open.php');
include('../shared/nav.php');

?>

<div style="background-color:#F5F6FA; min-height:100vh;">

    <div class="container py-5">

        <!-- Alert Messages -->

        <?php include('../shared/alert.php'); ?>


        <!-- Title -->

        <div class="text-center mb-5">

            <h1
                class="fw-bold"
                style="color:#17365D;"
            >

                <i
                    class="bi bi-heart-fill"
                    style="color:#EF476F;"
                ></i>

                My Favorites

            </h1>

            <p class="text-muted fs-5">

                Products you added to your favorites

            </p>

        </div>


        <div class="row g-4">


            <?php if (mysqli_num_rows($result) > 0) { ?>


                <?php while ($item = mysqli_fetch_assoc($result)) { ?>


                    <div class="col-lg-3 col-md-4 col-sm-6">

                        <div
                            class="card h-100 shadow-sm border-0"
                        >


                            <!-- Product Image -->

                            <img
                                src="../images/products/<?php echo $item['image']; ?>"
                                alt="<?php echo $item['name']; ?>"
                                class="card-img-top"
                                style="
                                    height:180px;
                                    object-fit:cover;
                                "
                            >


                            <div class="card-body">


                                <!-- Product Name -->

                                <h5
                                    class="card-title"
                                    style="color:#17365D;"
                                >

                                    <?php echo $item['name']; ?>

                                </h5>


                                <!-- Price -->

                                <h6 style="color:#2F8FEF;">

                                    $<?php echo $item['price']; ?>

                                </h6>


                                <!-- Description -->

                                <p class="text-muted">

                                    <?php echo $item['description']; ?>

                                </p>


                                <!-- Category -->

                                <p>

                                    <strong>
                                        Category:
                                    </strong>

                                    <?php echo $item['category_name']; ?>

                                </p>


                                <!-- Remove Favorite -->

                                <div class="d-flex justify-content-center">

                                    <a
                                        href="favorites.php?remove=<?php echo $item['id']; ?>"
                                        class="btn btn-outline-danger"
                                    >

                                        <i class="bi bi-heart-fill"></i>

                                        Remove Favorite

                                    </a>

                                </div>


                            </div>

                        </div>

                    </div>


                <?php } ?>


            <?php } else { ?>


                <!-- No Favorites -->

                <div class="col-12 text-center">

                    <div class="py-5">

                        <i
                            class="bi bi-heart"
                            style="
                                font-size:70px;
                                color:#EF476F;
                            "
                        ></i>


                        <h3
                            class="mt-3"
                            style="color:#17365D;"
                        >

                            No Favorites Yet

                        </h3>


                        <p class="text-muted">

                            You haven't added any products to your favorites yet.

                        </p>


                        <a
                            href="list.php"
                            class="btn text-white mt-2"
                            style="
                                background-color:#2F8FEF;
                            "
                        >

                            <i class="bi bi-shop"></i>

                            Browse Products

                        </a>

                    </div>

                </div>


            <?php } ?>


        </div>

    </div>

</div>


<?php

include('../shared/close.php');

?>