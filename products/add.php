<?php

include('../shared/database.php');
//add new Product========================
$successmessage="";
 $errormessage="";
if(isset($_POST['btn'])){
    $name=$_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['cat_id'];
    try{

    if(strlen($name)<=3){
         $errormessage=" Product Name Should be Greater Than 3 Character";
    }else if(strlen($name)>20){
  $errormessage=" Category Name Should be Less Than 20 Character";
    }else{

    $InsertQuery="INSERT INTO products (name, price, description, image, available_qty, cat_id) 
                VALUES ('$name', '$price', '$description', '', '$quantity', '$cat_id')";
    $result=mysqli_query($conn, $InsertQuery);
$successmessage="Product added Successfully";

    }
    }catch( Exception $e){

 $errormessage=" Product Failed".$e->getMessage();
  
 
    }
   


}


?>


<!--============== html===================== -->
<?php
include('../shared/open.php');
include('../shared/nav.php');
?>



<div class="container py-5">
    <div class="row  justify-content-center ">
        <div class="col-md-8 p-4 ">
          <?php include('../shared/alert.php'); ?>

   

           
          <h1  class=" py-2 text-center"style=" color:#854EE4;">Add New Product</h1>
            
        </div>
    </div>
</div>

<div class="container py-5 col-6"style=" background-color:#854EE4;"  >
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">

        <form action="" method="POST">
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label text-white"> Product Name</label>
    <input type="text" class="form-control" name="product_name">
  </div>
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label text-white"> Price</label>
    <input type="number" class="form-control" name="price">
  </div>
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label text-white"> description</label>
    <input type="text" class="form-control" name="description">
  </div>
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label text-white"> avilable_quantity</label>
    <input type="number" class="form-control" name="quantity">
  </div>
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label text-white"> cat_id</label>
    <input type="number" class="form-control" name="cat_id">
  </div>
  <div class="text-center ">
  <button type="submit" class="btn  "style=" background-color:#FAF7FF; color:#854EE4;" name="btn" >Submit</button>
</div>
</form>
          
            
        </div>
    </div>
</div>


    
  



  <?php
include('../shared/close.php');


?>