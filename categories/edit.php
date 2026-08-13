<?php

include('../shared/database.php');
//edit  category========================
$successmessage="";
 $errormessage="";
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $categoryquer="SELECT * FROM categories WHERE id=$id";
    $oldcategory=mysqli_query($conn,$categoryquer);
    $row=mysqli_num_rows( $oldcategory);
    if($row>0){
        $category=mysqli_fetch_assoc( $oldcategory);

        $name= $category['name'];
        $oldimage = $category['image'];

    }   
}


if(isset($_POST['btn'])){

    $name = $_POST['cat_name'];

    try{

        if(strlen($name) <= 3){

            $errormessage = "Category Name Should be Greater Than 3 Character";

        }else if(strlen($name) > 20){

            $errormessage = "Category Name Should be Less Than 20 Character";

        }else{

            // If user selected a new image
            if(isset($_FILES['cat_image']) && $_FILES['cat_image']['error'] == 0){

                $image = $_FILES['cat_image']['name'];
                $tmpName = $_FILES['cat_image']['tmp_name'];

                $uploadPath = "../images/categories/" . $image;

                move_uploaded_file($tmpName, $uploadPath);

                $updatequery = "UPDATE categories
                                SET name='$name', image='$image'
                                WHERE id=$id";

            }else{

                // Keep old image
                $updatequery = "UPDATE categories
                                SET name='$name'
                                WHERE id=$id";
            }

            $updateresult = mysqli_query($conn, $updatequery);

            if($updateresult){

                $successmessage = "Category updated successfully";

            }else{

                $errormessage = "Failed to update category: "
                              . mysqli_error($conn);
            }
        }

    }catch(Exception $e){

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
            <i class="bi bi-pencil-square"></i>
            Update Category
        </h2>

        <p class="text-secondary">
            Update the name of your category.
        </p>

    </div>


    <!-- Alert -->
    <?php include('../shared/alert.php'); ?>


    <!-- Update Form -->
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form action="" method="POST" enctype="multipart/form-data">

                <!-- Category ID -->
                <input
                    type="hidden"
                    name="cat_id"
                    value="<?php echo $id; ?>"
                >


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
                        value="<?php echo $name; ?>"
                        required
                    >

                </div>
                      
                <!-- category image-->
                  <div class="mb-4">
                      <label class="form-label">Category Image</label>

                       <input
                          type="file"
                          class="form-control"
                           name="cat_image"
                           accept="image/*"
                          >
                          <?php if(!empty($oldimage)){ ?>

                               <div class="mt-3">
                                  <p class="mb-2">Current Image:</p>

                                 <img
                                 src="../images/categories/<?php echo $oldimage; ?>"
                                 alt="<?php echo $name; ?>"
                                class="edit-category-image"
                                   >
                                  </div>

                          <?php } ?>
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

                        <i class="bi bi-check-lg"></i>
                        Update Category

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<?php
include('../shared/close.php');
?>