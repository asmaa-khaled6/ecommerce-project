<?php

include('../shared/permissions.php');

include('../shared/database.php');

$successmessage = "";
$errormessage = "";


// ================= Delete Category =================

if (isAdmin() && isset($_GET['delete'])) {

    $id = $_GET['delete'];

    try {

        $deletequey = "DELETE FROM categories WHERE id=$id";

        $deleteresult = mysqli_query($conn, $deletequey);

        if ($deleteresult) {

            $successmessage = "Deleted Successfully";

        } else {

            $errormessage = "Can Not Deleted";

        }

    } catch (Exception $e) {

        $errormessage = "Can Not Deleted";

    }
}


// ================= All Categories =================

$clientsquery = "SELECT * FROM categories";

$categories = mysqli_query($conn, $clientsquery);

?>

<?php

include('../shared/open.php');

include('../shared/nav.php');

?>


<div class="container py-5">


    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="category-title mb-1">

                <i class="bi bi-grid"></i>

                All Categories

            </h2>

            <p class="text-secondary mb-0">

                Manage your store categories.

            </p>

        </div>


        <!-- Add Category - Admin Only -->

        <?php if (isAdmin()) { ?>

            <a
                href="./add.php"
                class="btn add-btn btn-info"
            >

                <i class="bi bi-plus-lg"></i>

                Add Category

            </a>

        <?php } ?>

    </div>


    <!-- Alert Messages -->

    <?php include('../shared/alert.php'); ?>


    <!-- Categories Cards -->

    <div class="row g-4">

        <?php foreach ($categories as $item) { ?>

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card h-100 border-0 shadow-sm">


                    <!-- Category Image -->

                    <img
                        src="../images/categories/<?php echo $item['image']; ?>"
                        alt="<?php echo $item['name']; ?>"
                        class="card-img-top"
                        style="width: 100%; height: 220px; object-fit: cover;"
                    >


                    <div class="card-body text-center p-3">


                        <!-- Category Name -->

                        <h5 class="card-title mb-3">

                            <?php echo $item['name']; ?>

                        </h5>


                        <!-- ID -->

                        <p class="text-secondary small mb-3">

                            ID: <?php echo $item['id']; ?>

                        </p>


                        <!-- Actions - Admin Only -->

                        <?php if (isAdmin()) { ?>

                            <!-- Edit -->

                            <a
                                href="./edit.php?edit=<?php echo $item['id']; ?>"
                                class="btn btn-sm edit-btn me-2"
                                style="background-color:#2F8FEF"
                            >

                                <i class="bi bi-pencil-square"></i>

                                Edit

                            </a>


                            <!-- Delete -->

                            <a
                                href="./list.php?delete=<?php echo $item['id']; ?>"
                                class="btn btn-sm delete-btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this category?')"
                            >

                                <i class="bi bi-trash"></i>

                                Delete

                            </a>

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