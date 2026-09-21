<?php

session_start();

include('../shared/permissions.php');
include('../shared/database.php');

$successmessage = $_SESSION['successmessage'] ?? "";
$errormessage = $_SESSION['errormessage'] ?? "";

unset($_SESSION['successmessage']);
unset($_SESSION['errormessage']);



/* ================= ADD / REMOVE FAVORITE ================= */

if (isset($_GET['favorite'])) {

    if (!isset($_SESSION['user_id'])) {

        header("Location: ../clients/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['favorite'];

    // Check if product is already in favorites
    $checkFavorite = "SELECT * FROM favorites
                      WHERE user_id=$user_id
                      AND product_id=$product_id";

    $checkResult = mysqli_query($conn, $checkFavorite);

    if (mysqli_num_rows($checkResult) > 0) {

        // Remove from favorites
        $deleteFavorite = "DELETE FROM favorites
                           WHERE user_id=$user_id
                           AND product_id=$product_id";

        if (mysqli_query($conn, $deleteFavorite)) {

            $successmessage = "Product Removed From Favorites Successfully";

        } else {

            $errormessage = "Failed To Remove Product From Favorites";

        }

    } else {

        // Add to favorites
        $addFavorite = "INSERT INTO favorites
                        (user_id, product_id)
                        VALUES
                        ($user_id, $product_id)";

        if (mysqli_query($conn, $addFavorite)) {

            $successmessage = "Product Added To Favorites Successfully";

        } else {

            $errormessage = "Failed To Add Product To Favorites";

        }
    }
}


/* ================= DELETE PRODUCT ================= */

if (isset($_GET['delete'])) {

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

        $id = $_GET['delete'];

        $deleteQuery = "DELETE FROM products WHERE id=$id";

        if (mysqli_query($conn, $deleteQuery)) {

            $successmessage = "Product Deleted Successfully";

        } else {

            $errormessage = "Failed To Delete Product";

        }

    }
}


/* ================= GET ALL PRODUCTS ================= */

/* ================= SEARCH + GET ALL PRODUCTS ================= */

$search = $_GET['search'] ?? '';

$listQuery = " 
    SELECT 
        products.*, 
        categories.name AS category_name 
    FROM products 
    LEFT JOIN categories 
        ON products.category_id = categories.id
   WHERE LOWER(products.name) LIKE LOWER('%$search%')
";

$list = mysqli_query($conn, $listQuery);
?>


<?php

include('../shared/open.php');
include('../shared/nav.php');

?>


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8 p-4">

            <?php include('../shared/alert.php'); ?>

            <h1
                class="py-2 text-center"
                style="color:#17365D;"
            >

                List All Products

            </h1>



<form method="GET" class="mt-3">
    <div class="input-group mx-auto" style="max-width:350px;">

        <input 
            type="text" 
            name="search" 
            class="form-control"
            style="border-radius:25px 0 0 25px; font-size:14px;"
            placeholder="Search..."
            value="<?php echo htmlspecialchars($search); ?>"
        >

        <button 
            type="submit"
            class="btn"
            style="
                background-color:#2F8FEF;
                color:#FFFFFF;
                border-radius:0 25px 25px 0;
                width:45px;
            "
        >
            <i class="bi bi-search"></i>
        </button>

    </div>
</form>
        </div>

    </div>

</div>


<div class="container">

    <div class="row g-4 justify-content-center">


        <?php foreach($list as $item){ ?>


            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">


                <div class="card h-100 shadow-sm border-0">


                    <!-- ================= Image ================= -->

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


                        <!-- ================= Name ================= -->

                        <h5
                            class="card-title"
                            style="color:#17365D;"
                        >

                            <?php echo $item['name']; ?>

                        </h5>


                        <!-- ================= Price ================= -->

                        <h6 style="color:#2F8FEF;">

                            $<?php echo $item['price']; ?>

                        </h6>
                        


                        <!-- ================= Description ================= -->

                        <p class="text-muted">

                            <?php echo $item['description']; ?>

                        </p>


                        <!-- ================= Quantity ================= -->

                        <p>

                            <strong>Available:</strong>

                            <?php echo $item['Quantity_avaliable']; ?>

                        </p>


                        <!-- ================= Category ================= -->

                        <p>

                            <strong>Category:</strong>

                            <?php echo $item['category_name']; ?>

                        </p>


                        <!-- ================= Buttons ================= -->


                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>


                            <!-- ================= ADMIN ================= -->

                            <div class="d-flex justify-content-between">


                                <!-- Edit -->

                                <a
                                    href="./edit.php?edit=<?php echo $item['id']; ?>"
                                    class="btn"
                                    style="
                                        background-color:#2F8FEF;
                                        color:#FFFFFF;
                                    "
                                >

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </a>


                                <!-- Delete -->

                                <a
                                    href="./list.php?delete=<?php echo $item['id']; ?>"
                                    class="btn btn-outline-danger"
                                >

                                    <i class="bi bi-trash"></i>

                                    Delete

                                </a>


                            </div>


                        <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') { ?>


                            <!-- ================= USER ================= -->

                            <div class="d-flex justify-content-between">


                                <?php

                                $user_id = $_SESSION['user_id'];

                                $checkFavorite = "SELECT * FROM favorites
                                                  WHERE user_id=$user_id
                                                  AND product_id=" . $item['id'];

                                $favoriteResult = mysqli_query(
                                    $conn,
                                    $checkFavorite
                                );

                                $isFavorite = mysqli_num_rows(
                                    $favoriteResult
                                ) > 0;

                                ?>


                                <!-- Favorite -->

                                <a
                                    href="./list.php?favorite=<?php echo $item['id']; ?>"
                                    class="btn btn-outline-danger"
                                >

                                    <?php if ($isFavorite) { ?>

                                        <i class="bi bi-heart-fill"></i>

                                        Favorite

                                    <?php } else { ?>

                                        <i class="bi bi-heart"></i>

                                        Favorite

                                    <?php } ?>

                                </a>


                                <!-- Add To Cart -->

                                <a
    href="./addtocart.php?add=<?php echo $item['id']; ?>"
    class="btn"
    style="
        background-color:#2F8FEF;
        color:#FFFFFF;
    "
>

    <i class="bi bi-cart-plus"></i>

    Add to Cart

</a>

                            </div>


                        <?php } else { ?>


                            <!-- ================= GUEST ================= -->

                            <div class="text-center">


                                <a
                                    href="../clients/login.php"
                                    class="btn"
                                    style="
                                        background-color:#2F8FEF;
                                        color:#FFFFFF;
                                    "
                                >

                                    <i class="bi bi-box-arrow-in-right"></i>

                                    Login to Continue

                                </a>


                            </div>


                        <?php } ?>


                    </div>

                </div>

            </div>


        <?php } ?>


    </div>

</div>


<?php

include('../shared/close.php');

?>