<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";

/* Get Categories */
$categoryQuery = "SELECT * FROM categories";
$categories = mysqli_query($conn, $categoryQuery);

/*GEt Brands*/
$brandQuery = "SELECT * FROM brands";
$brands = mysqli_query($conn, $brandQuery);


/* Add New Product */
if (isset($_POST['btn'])) {

    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['cat_id'];
    $image = $_FILES['product_image']['name'];
    $tmpName = $_FILES['product_image']['tmp_name'];

    $uploadPath = "../images/products/" . $image;

    move_uploaded_file($tmpName, $uploadPath);
    $brand_id = $_POST['brand_id'];

    try {

        if (strlen($name) <= 3) {

            $errormessage = "Product Name Should be Greater Than 3 Characters";

        } else if (strlen($name) > 20) {

            $errormessage = "Product Name Should be Less Than 20 Characters";

        } else if ($price <= 0) {

            $errormessage = "Price Should be Greater Than 0";

        } else if ($quantity < 0) {

            $errormessage = "Quantity Cannot be Negative";

        } else {

            $InsertQuery = "INSERT INTO products 
            (name, price, description, Quantity_avaliable, category_id, image , brand_id)
            VALUES 
            ('$name', '$price', '$description', '$quantity', '$cat_id', '$image', '$brand_id')";

            $result = mysqli_query($conn, $InsertQuery);

            if ($result) {
                $successmessage = "Product Added Successfully";
            } else {
                $errormessage = "Product Failed: " . mysqli_error($conn);
            }
        }

    } catch (Exception $e) {

        $errormessage = "Product Failed: " . $e->getMessage();
    }
}

?>

<!-- HTML -->

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>


<div class="product-form-section container-fluid py-5">

    <?php include('../shared/alert.php'); ?>

    <div class="text-center mb-4">

        <h1 style="color:#17365D;">
            Add New Product
        </h1>

        <p style="color:#6c757d;">
            Fill in the information to add a new product.
        </p>

    </div>


    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <form action="" method="POST" enctype="multipart/form-data">

                        <!-- Product Name -->

                        <div class="mb-3">

                            <label class="form-label">
                                Product Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="product_name"
                                placeholder="Enter product name"
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
                                placeholder="Enter product price"
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
                                placeholder="Enter product description"
                            ></textarea>

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
                                placeholder="Enter available quantity"
                                min="0"
                                required
                            >

                        </div>


                        <!-- Category -->

                        <div class="mb-4">

                            <label class="form-label">
                                Category
                            </label>

                            <select
                                class="form-select"
                                name="cat_id"
                                required
                            >

                                <option value="">
                                    Select Category
                                </option>

                                <?php foreach ($categories as $category) { ?>

                                    <option value="<?php echo $category['id']; ?>">

                                        <?php echo $category['name']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>


                        <div class="mb-4">

                           <label class="form-label">
                              Product Image
                           </label>

                          <input
                             type="file"
                             class="form-control"
                             name="product_image"
                             accept="image/*"
                             required
                          >

                        </div>

          <!-- ==================Brand====================== -->
                 
                  <div class="mb-4">

                   <label class="form-label">
                       Brand
                   </label>

                   <select
                    class="form-select"
                    name="brand_id"
                    required
                   >

                     <option value="">
                        Select Brand
                     </option>

                     <?php foreach ($brands as $brand) { ?>

                         <option value="<?php echo $brand['id']; ?>">
                             <?php echo $brand['name']; ?>
                         </option>
       
                     <?php } ?>

                   </select>

                  </div>


                        <!-- Buttons -->

                        <div class="d-flex justify-content-end gap-2">

    <a 
        href="list.php" 
        class="btn text-white" 
        style="background-color:#2F8FEF;"
    > 
        <i class="bi bi-eye"></i>
        View All
    </a>

                            <a
                                href="list.php"
                                class="btn btn-light"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                name="btn"
                                class="btn"
                                style="
                                    background-color:#2F8FEF;
                                    color:#FFFFFF;
                                "
                            >

                                <i class="bi bi-plus-lg"></i>
                                Add Product

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