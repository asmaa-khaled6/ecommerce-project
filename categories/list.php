<?php

include('../shared/database.php');

$successmessage="";
 $errormessage="";


// delete category
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    try{
 $deletequey="DELETE FROM categories where id=$id";
    $deleteresult=mysqli_query($conn,$deletequey);
    if($deleteresult){
        $successmessage="Deleted Successfully";
    }else{
         $errormessage=" Can Not Deleted";
    }


    }catch(Exception $e){


    }

   
}
//all category
$clientsquery=" SELECT * FROM categories";
$categories=mysqli_query($conn,$clientsquery);

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

        <a href="./add.php" class="btn add-btn">
            <i class="bi bi-plus-lg"></i>
            Add Category
        </a>

    </div>


    <!-- Alert Messages -->
    <?php include('../shared/alert.php'); ?>


    <!-- Categories Table -->
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0" category-table>

                    <thead class="category-table-head">

                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category Name</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach($categories as $item){ ?>

                            <tr>

                                <td>
                                    <?php echo $item['id']; ?>
                                </td>
                                <td >
                                 <img
                                   src="../images/categories/<?php echo $item['image']; ?>"
                                   alt="<?php echo $item['name']; ?>"
                                   class="category-table-image"
                                   style="width: 70px; height:70px; object-fit: cover; border-radius:8px ; position:relative; left:-65px;"
                                  >
                                </td>

                                <td class="category-name">
                                    <?php echo $item['name']; ?>
                                </td>

                                <td class="text-center">

                                    <!-- Edit -->
                                    <a
                                        href="./edit.php?edit=<?php echo $item['id']; ?>"
                                        class="btn btn-sm edit-btn me-2">

                                        <i class="bi bi-pencil-square"></i>
                                        Edit

                                    </a>


                                    <!-- Delete -->
                                    <a
                                        href="./list.php?delete=<?php echo $item['id']; ?>"
                                        class="btn btn-sm delete-btn">

                                        <i class="bi bi-trash"></i>
                                        Delete

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<?php
include('../shared/close.php');
?>