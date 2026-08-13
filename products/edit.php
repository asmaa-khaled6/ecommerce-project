<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";


/* ================= GET OLD PRODUCT ================= */

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $productQuery = "
        SELECT * FROM products
        WHERE id=$id
    ";

    $oldProduct = mysqli_query($conn, $productQuery);

    if(mysqli_num_rows($oldProduct) > 0){

        $product = mysqli_fetch_assoc($oldProduct);

        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
        $quantity = $product['Quantity_avaliable'];
        $cat_id = $product['category_id'];
        $oldImage = $product['image'];

    }

}


/* ================= GET CATEGORIES ================= */

$categoryQuery = "SELECT * FROM categories";
$categories = mysqli_query($conn, $categoryQuery);


/* ================= UPDATE PRODUCT ================= */

if(isset($_POST['btn'])){

    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['cat_id'];

    try{

        if(strlen($name) <= 3){

            $errormessage =
                "Product Name Should be Greater Than 3 Characters";

        }else if(strlen($name) > 20){

            $errormessage =
                "Product Name Should be Less Than 20 Characters";

        }else if($price <= 0){

            $errormessage =
                "Price Should be Greater Than 0";

        }else if($quantity < 0){

            $errormessage =
                "Quantity Cannot be Negative";

        }else{

            /* Check if user uploaded a new image */

            if(!empty($_FILES['product_image']['name'])){

                $image = $_FILES['product_image']['name'];
                $tmpName = $_FILES['product_image']['tmp_name'];

                $uploadPath = "../images/products/" . $image;

                move_uploaded_file(
                    $tmpName,
                    $uploadPath
                );

                $updateQuery = "
                    UPDATE products SET
                    name='$name',
                    price='$price',
                    description='$description',
                    Quantity_avaliable='$quantity',
                    category_id='$cat_id',
                    image='$image'
                    WHERE id=$id
                ";

            }else{

                /* Keep old image */

                $updateQuery = "
                    UPDATE products SET
                    name='$name',
                    price='$price',
                    description='$description',
                    Quantity_avaliable='$quantity',
                    category_id='$cat_id'
                    WHERE id=$id
                ";

            }


            $updateResult =
                mysqli_query($conn, $updateQuery);


            if($updateResult){

                $successmessage =
                    "Product Updated Successfully";

            }else{

                $errormessage =
                    "Product Update Failed: "
                    . mysqli_error($conn);

            }

        }

    }catch(Exception $e){

        $errormessage =
            "Product Failed: "
            . $e->getMessage();

    }

}

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
                Update Product
            </h1>

        </div>

    </div>

</div>


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div
                class="card border-0 shadow-sm"
                style="border-radius:15px;"
            >

                <div class="card-body p-4">


                    <form
                        action=""
                        method="POST"
                        enctype="multipart/form-data"
                    >


                        <!-- Product Name -->

                        <div class="mb-3">

                            <label class="form-label">
                                Product Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="product_name"
                                value="<?php echo $name; ?>"
                                required
                            >

                        </div>


                        <!-- Price -->

                        <div class="mb-3">

                            <label class="form-label">
                                Price
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                class="form-control"
                                name="price"
                                value="<?php echo $price; ?>"
                                required
                            >

                        </div>


                        <!-- Description -->

                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                class="form-control"
                                name="description"
                                rows="4"
                            ><?php echo $description; ?></textarea>

                        </div>


                        <!-- Quantity -->

                        <div class="mb-3">

                            <label class="form-label">
                                Available Quantity
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="quantity"
                                value="<?php echo $quantity; ?>"
                                min="0"
                                required
                            >

                        </div>


                        <!-- Category -->

                        <div class="mb-3">

                            <label class="form-label">
                                Category
                            </label>

                            <select
                                class="form-select"
                                name="cat_id"
                                required
                            >

                                <?php foreach($categories as $category){ ?>

                                    <option
                                        value="<?php echo $category['id']; ?>"
                                        <?php
                                        if($category['id'] == $cat_id){
                                            echo "selected";
                                        }
                                        ?>
                                    >

                                        <?php echo $category['name']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>


                        <!-- Brand - TEMPORARILY COMMENTED -->

                        <!--

                        <div class="mb-3">

                            <label class="form-label">
                                Brand
                            </label>

                            <select
                                class="form-select"
                                name="brand_id"
                            >

                                <option value="">
                                    Select Brand
                                </option>

                            </select>

                        </div>

                        -->


                        <!-- Current Image -->

                        <div class="mb-3">

                            <label class="form-label">
                                Current Image
                            </label>

                            <br>

                            <img
                                src="../images/products/<?php echo $oldImage; ?>"
                                alt="<?php echo $name; ?>"
                                style="
                                    width:120px;
                                    height:120px;
                                    object-fit:cover;
                                    border-radius:10px;
                                "
                            >

                        </div>


                        <!-- New Image -->

                        <div class="mb-4">

                            <label class="form-label">
                                Change Image
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                name="product_image"
                                accept="image/*"
                            >

                            <small class="text-muted">
                                Leave empty if you want to keep
                                the current image.
                            </small>

                        </div>


                        <!-- Buttons -->

                        <div class="text-center">

                            <button
                                type="submit"
                                name="btn"
                                class="btn"
                                style="
                                    background-color:#2F8FEF;
                                    color:#FFFFFF;
                                "
                            >

                                <i class="bi bi-pencil-square"></i>

                                Update Product

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<?php

include('../shared/close.php');

?>