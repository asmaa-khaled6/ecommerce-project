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

    <div class="row justify-content-center">

        <div
            class="col-11 table-responsive rounded"
            style="
                background-color:#FFFFFF;
                padding:10px;
                border:1px solid #DCEEFF;
            "
        >

            <table class="table table-hover align-middle">

                <thead
                    style="
                        background-color:#17365D;
                        color:#FFFFFF;
                    "
                >

                    <tr class="text-center">

                        <th>ID</th>

                        <th>Image</th>

                        <th>Name</th>

                        <th>Price</th>

                        <th>Description</th>

                        <th>Available Qty</th>

                        <th>Category</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach($list as $item){ ?>

                        <tr class="text-center">

                            <!-- ID -->

                            <td>
                                <?php echo $item['id']; ?>
                            </td>


                            <!-- Image -->

                            <td>

                                <img
                                    src="../images/products/<?php echo $item['image']; ?>"
                                    alt="<?php echo $item['name']; ?>"
                                    style="
                                        width:70px;
                                        height:70px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    "
                                >

                            </td>


                            <!-- Name -->

                            <td>
                                <?php echo $item['name']; ?>
                            </td>


                            <!-- Price -->

                            <td>
                                $<?php echo $item['price']; ?>
                            </td>


                            <!-- Description -->

                            <td>
                                <?php echo $item['description']; ?>
                            </td>


                            <!-- Quantity -->

                            <td>
                                <?php echo $item['Quantity_avaliable']; ?>
                            </td>


                            <!-- Category -->

                            <td>
                                <?php echo $item['category_name']; ?>
                            </td>


                            <!-- Actions -->

                            <td>

                                <a
                                    class="mx-2 fs-5 text-danger"
                                    href="./list.php?delete=<?php echo $item['id']; ?>"
                                >

                                    <i class="bi bi-trash"></i>

                                </a>


                                <a
                                    class="mx-2 fs-5"
                                    style="color:#2F8FEF;"
                                    href="./edit.php?edit=<?php echo $item['id']; ?>"
                                >

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php

include('../shared/close.php');

?>