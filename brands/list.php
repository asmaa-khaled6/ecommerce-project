<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";


// Delete Brand
if (isset($_POST['delete_brand'])) {

    $id = (int) $_POST['brand_id'];

    $deletequery = "DELETE FROM brands WHERE id = $id";

    $deleteresult = mysqli_query($conn, $deletequery);

    if ($deleteresult) {

        $successmessage = "Brand Deleted Successfully";

    } else {

        $errormessage = "Brand Delete Failed";
    }
}


// Get Brands
$query = "SELECT * FROM brands";

$result = mysqli_query($conn, $query);


?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>

<div class="container py-5">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-1" style="color: #17365D;">

                Brands List

            </h1>

            <p class="text-secondary fs-5 mb-0">
                View and manage all brands.
            </p>

        </div>


        <a href="add.php" class="btn btn-primary">

            <i class="fa-solid fa-plus me-1"></i>

            Add New Brand

        </a>

    </div>
<?php include('../shared/alert.php');
 ?>

    <!-- Brands Cards -->

    <div class="row g-4">

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($brand = mysqli_fetch_assoc($result)) {

        ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm border-0">

                        <!-- Image -->

                        <img
                            src="../images/<?php echo $brand['image']; ?>"
                            class="card-img-top"
                            alt="<?php echo $brand['name']; ?>"
                            style="height: 220px; object-fit: contain; padding: 15px;"
                        >


                        <div class="card-body text-center">

                            <!-- Brand Name -->

                            <h4
                                class="card-title mb-4"
                                style="color: #17365D;"
                            >

                                <?php echo $brand['name']; ?>

                            </h4>


                            <!-- View Products -->
<a
    href="../products/list.php?brand_id=<?php echo $brand['id']; ?>"
    class="btn btn-primary w-100 mb-2">
    View Products
</a>


                            <!-- Edit & Delete -->

                            <div class="d-flex gap-2">     
   <a href="edit.php?id=<?php echo $brand['id']; ?>"
    class="btn btn-outline-primary w-50">
    Edit
</a>
<form method="POST" class="w-50">

    <input
        type="hidden"
        name="brand_id"
        value="<?php echo $brand['id']; ?>"
    >

    <button
        type="submit"
        name="delete_brand"
        class="btn btn-outline-danger w-100"
        onclick="return confirm('Are you sure you want to delete this brand?');"> Delete

    </button>

</form>

                            </div>

                        </div>

                    </div>

                </div>

        <?php

            }

        } else {

        ?>

            <div class="col-12">

                <div class="alert alert-info text-center">

                    No brands found.

                </div>

            </div>

        <?php

        }

        ?>

    </div>

</div>

<?php
include('../shared/close.php');
?>