

<?php
include('../shared/database.php');
//add new category========================
$successmessage="";
 $errormessage="";
if(isset($_POST['btn'])){
    
   $name = $_POST['cat_name'];

$image = $_FILES['cat_image']['name'];
$tmpName = $_FILES['cat_image']['tmp_name'];

try {

    if(strlen($name) <= 3){

        $errormessage = "Category Name Should be Greater Than 3 Character";

    } else if(strlen($name) > 20){

        $errormessage = "Category Name Should be Less Than 20 Character";

    } else {

        $uploadPath = "../images/categories/" . $image;

        move_uploaded_file($tmpName, $uploadPath);

        $InsertQuery = "INSERT INTO categories (name, image)
                        VALUES ('$name', '$image')";

        $result = mysqli_query($conn, $InsertQuery);

        if($result){

            $successmessage = "Category added Successfully";

        } else {

            $errormessage = "Category Failed" . mysqli_error($conn);

        }
    }

} catch(Exception $e) {

    $errormessage = "Category Failed " . $e->getMessage();

}


}


?>


<!--============== html===================== -->

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>

<div class="container py-5">

    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="category-title">
            <i class="bi bi-grid"></i>
            Add New Category
        </h2>

        <p class="text-secondary">
            Create a new category for your store.
        </p>
    </div>


    <!-- Alert -->
    <?php include('../shared/alert.php'); ?>


    <!-- Form Card -->
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form action="" method="POST" enctype="multipart/form-data">

                <!-- Category Name -->
                <div class="mb-4">

                    <label for="categoryName" class="form-label">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="categoryName"
                        class="form-control"
                        name="cat_name"
                        placeholder="Enter category name"
                        required
                    >

                </div>

                <!-- Category Image-->
                 <div class="mb-4">
                    <label for="categoryImage" class="form-label">
                      Category Image
                    </label>
                    <input
                    type="file"
                    id="categoryImage"
                    class="form-control"
                    name="cat_image"
                    accept="image/*"
                    required
                    >
                 </div>


                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2">

                    <a href="./list.php" class="btn btn-light">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn add-btn"
                        name="btn">

                        <i class="bi bi-plus-lg"></i>
                        Add Category

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<?php
include('../shared/close.php');
?>
