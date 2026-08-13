<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";


/* ================= DELETE PRODUCT ================= */

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    try{

        $deleteQuery = "DELETE FROM products WHERE id=$id";

        $deleteResult = mysqli_query($conn, $deleteQuery);

        if($deleteResult){

            $successmessage = "Product Deleted Successfully";

        }else{

            $errormessage = "Cannot Delete Product";

        }

    }catch(Exception $e){

        $errormessage = "Product Failed: " . $e->getMessage();

    }

}


/* ================= GET ALL PRODUCTS ================= */

$listQuery = "
    SELECT 
        products.*,
        categories.name AS category_name
    FROM products
    LEFT JOIN categories
        ON products.category_id = categories.id
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

        </div>

    </div>

</div>


<div class="container">

    <div class="row g-4">

        <?php foreach($list as $item){ ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card h-100 shadow-sm border-0">

                    <!-- Image -->
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

                        <!-- Name -->
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

                        <!-- Quantity -->
                        <p>
                            <strong>Available:</strong>
                            <?php echo $item['Quantity_avaliable']; ?>
                        </p>

                        <!-- Category -->
                        <p>
                            <strong>Category:</strong>
                            <?php echo $item['category_name']; ?>
                        </p>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">

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

                            <a
                                href="./list.php?delete=<?php echo $item['id']; ?>"
                                class="btn btn-outline-danger"
                            >
                                <i class="bi bi-trash"></i>
                                Delete
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>


<?php

include('../shared/close.php');

?>