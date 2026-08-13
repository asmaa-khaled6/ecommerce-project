<?php

include('../shared/database.php');

$successmessage = null;
$errormessage = null;

if (isset($_POST['btn'])) {

    $name = $_POST['name'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if (strlen($name) <= 3) {

        $errormessage = "Please enter brand name greater than 3 characters";

    } else {

        move_uploaded_file($image_tmp, "../images/" . $image);

        $query = "INSERT INTO brands (name, image)
                  VALUES ('$name', '$image')";

        $result = mysqli_query($conn, $query);

        if ($result) {

            $successmessage = "Brand added successfully";

        } else {

            $errormessage = "Something went wrong";

        }
    }
}

?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>

<div class="container py-5">
 <?php include('../shared/alert.php'); ?>

    <div class="mb-4">

        <div class="d-flex align-items-center">

            <div>

                <h1 class=" mb-1" style="color: #17365D;">
                    Add New Brand
                </h1>

                <p class="text-secondary mb-0 fs-5">
                    Fill in the information to add a new brand.
                </p>

            </div>

        </div>

    </div>



    <!-- Card -->

    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <form method="POST" enctype="multipart/form-data">

                <div class="row">

                    <!-- Brand Name -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label fs-5">
                            Brand Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control form-control-lg"
                            placeholder="Enter brand name"
                            required
                        >

                    </div>


                    <!-- Brand Image -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label fs-5">
                            Brand Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control form-control-lg"
                            accept="image/*"
                            required
                        >

                    </div>

                </div>


                <!-- Buttons -->

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="list.php"
                        class="btn btn-light border"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        name="btn"
                        class="btn btn-primary">

                        Add Brand

                    </button>


                    <a
                        href="list.php"
                        class="btn btn-primary">

                        View List

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<?php
include('../shared/close.php');
?>