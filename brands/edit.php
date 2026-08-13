<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";

$id = "";
$name = "";
$image = "";


// Get Brand Data
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $brandsquery = "SELECT * FROM brands WHERE id=$id";

    $oldbrands = mysqli_query($conn, $brandsquery);

    if (mysqli_num_rows($oldbrands) > 0) {

        $brand = mysqli_fetch_assoc($oldbrands);

        $name = $brand['name'];
        $image = $brand['image'];

    } else {

        $errormessage = "Brand Not Found";
    }
}


// Update Brand
if (isset($_POST['btn'])) {

    $id = $_GET['id'];

    $name = $_POST['name'];

    try {

        if (strlen($name) <= 3) {

            $errormessage = "Brand Name Should be Greater Than 3 Character";

        } elseif (strlen($name) > 30) {

            $errormessage = "Brand Name Should be Less Than 30 Character";

        } else {

            // Keep old image
            $newimage = $image;


            // Check if user selected new image
            if (!empty($_FILES['image']['name'])) {

                $newimage = $_FILES['image']['name'];

                $image_tmp = $_FILES['image']['tmp_name'];

                move_uploaded_file(
                    $image_tmp,
                    "../images/" . $newimage
                );
            }


            // Update Brand
            $updatequery = "UPDATE brands SET
                            name='$name',
                            image='$newimage'
                            WHERE id=$id";

            $updateresult = mysqli_query($conn, $updatequery);


            if ($updateresult) {

                $successmessage = "Brand Updated Successfully";

                // Update displayed values
                $image = $newimage;

            } else {

                $errormessage = "Brand Update Failed";
            }
        }

    } catch (Exception $e) {

        $errormessage = "Brand Update Failed " . $e->getMessage();
    }
}

?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <?php include('../shared/alert.php'); ?>


            <!-- Header -->

            <div class="mb-4">

                <div class="d-flex align-items-center">

                    <h1
                        class="py-2 mb-0"
                        style="
                            color: #17365D;
                            font-size: 1.75rem;
                        "
                    >
                        Update Brand
                    </h1>

                </div>


                <p class="text-muted mb-0">

                    Update the brand information.

                </p>

            </div>


            <!-- Card -->

            <div class="card p-4 shadow-sm border-0">

                <form
                    action=""
                    method="POST"
                    enctype="multipart/form-data"
                >

                    <div class="row">


                        <!-- Brand Name -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Brand Name

                            </label>


                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                value="<?php echo $name; ?>"
                                placeholder="Enter brand name"
                            >

                        </div>


                        <!-- Brand Image -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Brand Image

                            </label>


                            <input
                                type="file"
                                class="form-control"
                                name="image"
                                accept="image/*"
                            >

                        </div>


                        <!-- Current Image -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Current Image

                            </label>


                            <div class="mt-2">

                                <img
                                    src="../images/<?php echo $image; ?>"
                                    width="120"
                                    height="120"
                                    class="border rounded p-2"
                                    style="object-fit: contain;"
                                >

                            </div>

                        </div>


                    </div>


                    <!-- Buttons -->

                    <div class="d-flex justify-content-end mt-3 pe-2">


                        <a
                            href="list.php"
                            class="btn btn-light border me-2"
                        >

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary me-2"
                            name="btn"
                        >

                            Update Brand

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

</div>

<?php
include('../shared/close.php');
?>