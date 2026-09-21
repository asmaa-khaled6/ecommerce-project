<?php

session_start();

include('../shared/permissions.php');
include('../shared/database.php');


// ================= CHECK LOGIN =================

if (!isset($_SESSION['user_id'])) {

    header("Location: ../clients/login.php");
    exit;

}

$user_id = $_SESSION['user_id'];


// ================= REMOVE FROM CART =================

if (isset($_GET['remove'])) {

    $cart_id = $_GET['remove'];

    $deleteQuery = "DELETE FROM cart
                    WHERE id=$cart_id
                    AND user_id=$user_id";

    if (mysqli_query($conn, $deleteQuery)) {

        $_SESSION['successmessage'] =
            "Product Removed From Cart Successfully";

    } else {

        $_SESSION['errormessage'] =
            "Failed To Remove Product From Cart";

    }

    header("Location: cart.php");
    exit;
}


// ================= GET CART PRODUCTS =================

$cartQuery = "
    SELECT
        cart.id AS cart_id,
        cart.quantity,
        products.id AS product_id,
        products.name,
        products.price,
        products.image
    FROM cart
    INNER JOIN products
        ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
";

$cartResult = mysqli_query($conn, $cartQuery);

if (!$cartResult) {

    die("Query Error: " . mysqli_error($conn));

}


$cartProducts = [];

$total = 0;


while ($item = mysqli_fetch_assoc($cartResult)) {

    $item['subtotal'] =
        $item['price'] * $item['quantity'];

    $total += $item['subtotal'];

    $cartProducts[] = $item;

}

?>


<?php

include('../shared/open.php');
include('../shared/nav.php');

?>


<div style="background-color:#F5F6FA; min-height:100vh;">

    <div class="container py-5">


        <!-- ================= TITLE ================= -->

        <div class="text-center mb-5">

            <h1
                class="fw-bold"
                style="color:#17365D;"
            >

                <i
                    class="bi bi-cart3"
                    style="color:#2F8FEF;"
                ></i>

                My Cart

            </h1>

            <p class="text-muted">

                Products you added to your cart

            </p>

        </div>


        <!-- ================= ALERT ================= -->

        <?php include('../shared/alert.php'); ?>


        <?php if (count($cartProducts) > 0) { ?>


            <!-- ================= CART ================= -->

            <div class="row g-4">


                <!-- ================= PRODUCTS ================= -->

                <div class="col-lg-8">


                    <?php foreach ($cartProducts as $item) { ?>


                        <div
                            class="card shadow-sm border-0 rounded-4 mb-4"
                        >

                            <div class="card-body">

                                <div class="row align-items-center">


                                    <!-- ================= IMAGE ================= -->

                                    <div class="col-md-3 text-center">

                                        <img
                                            src="../images/products/<?php echo $item['image']; ?>"
                                            alt="<?php echo $item['name']; ?>"
                                            class="img-fluid rounded"
                                            style="
                                                width:120px;
                                                height:120px;
                                                object-fit:cover;
                                            "
                                        >

                                    </div>


                                    <!-- ================= PRODUCT INFO ================= -->

                                    <div class="col-md-5">

                                        <h5
                                            class="fw-bold"
                                            style="color:#17365D;"
                                        >

                                            <?php echo $item['name']; ?>

                                        </h5>


                                        <p
                                            class="mb-1"
                                            style="color:#2F8FEF;"
                                        >

                                            $<?php echo $item['price']; ?>

                                        </p>


                                        <p class="text-muted mb-0">

                                            Quantity:

                                            <?php echo $item['quantity']; ?>

                                        </p>

                                    </div>


                                    <!-- ================= SUBTOTAL ================= -->

                                    <div class="col-md-2 text-center">

                                        <small class="text-muted">

                                            Subtotal

                                        </small>

                                        <h5
                                            class="fw-bold"
                                            style="color:#17365D;"
                                        >

                                            $<?php echo $item['subtotal']; ?>

                                        </h5>

                                    </div>


                                    <!-- ================= REMOVE ================= -->

                                    <div class="col-md-2 text-center">

                                        <a
                                            href="cart.php?remove=<?php echo $item['cart_id']; ?>"
                                            class="btn btn-outline-danger"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </a>

                                    </div>


                                </div>

                            </div>

                        </div>


                    <?php } ?>


                </div>


                <!-- ================= SUMMARY ================= -->

                <div class="col-lg-4">

                    <div
                        class="card shadow-sm border-0 rounded-4"
                    >

                        <div class="card-body p-4">


                            <h4
                                class="fw-bold mb-4"
                                style="color:#17365D;"
                            >

                                Order Summary

                            </h4>


                            <div
                                class="d-flex justify-content-between mb-3"
                            >

                                <span>

                                    Products

                                </span>

                                <span>

                                    <?php echo count($cartProducts); ?>

                                </span>

                            </div>


                            <hr>


                            <div
                                class="d-flex justify-content-between"
                            >

                                <strong>

                                    Total

                                </strong>


                                <strong
                                    style="color:#2F8FEF;"
                                >

                                    $<?php echo $total; ?>

                                </strong>

                            </div>


                            <button
                                class="btn w-100 text-white mt-4"
                                style="
                                    background-color:#2F8FEF;
                                "
                            >

                                <i class="bi bi-credit-card"></i>

                                Checkout

                            </button>


                        </div>

                    </div>

                </div>


            </div>


        <?php } else { ?>


            <!-- ================= EMPTY CART ================= -->

            <div class="text-center py-5">


                <i
                    class="bi bi-cart-x"
                    style="
                        font-size:80px;
                        color:#2F8FEF;
                    "
                ></i>


                <h3
                    class="fw-bold mt-3"
                    style="color:#17365D;"
                >

                    Your Cart is Empty

                </h3>


                <p class="text-muted">

                    You haven't added any products yet.

                </p>


                <a
                    href="list.php"
                    class="btn text-white px-4"
                    style="
                        background-color:#2F8FEF;
                    "
                >

                    <i class="bi bi-shop"></i>

                    Continue Shopping

                </a>


            </div>


        <?php } ?>


    </div>

</div>


<?php

include('../shared/close.php');

?>