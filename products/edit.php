<?php

include('../shared/database.php');
//edit  category========================
$successmessage="";
 $errormessage="";
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $productquer="SELECT * FROM products WHERE id=$id";
    $oldproduct=mysqli_query($conn,  $productquer);
    $row=mysqli_num_rows( $oldproduct);
    if($row>0){
        $product=mysqli_fetch_assoc( $oldproduct);
        $name= $product['name'];
        $price = $product['price'];
        $description = $product['description'];
        $quantity = $product['available_qty'];
        $cat_id = $product['cat_id'];

    }   
}


 
if(isset($_POST['btn'])){
    $id = $_POST['product_id']; 
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['cat_id'];
    try{

    if(strlen($name)<=3){
         $errormessage=" Product Name Should be Greater Than 3 Character";
    }else if(strlen($name)>20){
  $errormessage=" Product Name Should be Less Than 20 Character";
    }else{
        $updatequery="UPDATE products SET name='$name', price='$price', description='$description', available_qty='$quantity', cat_id='$cat_id' WHERE id=$id";
         $updateresult=mysqli_query($conn, $updatequery);
         if($updateresult){
            $successmessage=" product updated successfully";
         }else{
             $errormessage=" failed update";
         }


    }
    }catch( Exception $e){

 $errormessage=" product Failed".$e->getMessage();
  
 
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

   

           
          <h1  class=" py-2 text-center"style=" color:#854EE4;">Update Product </h1>
            
        </div>
    </div>
</div>

<div class="container py-5 col-6"style=" background-color:#854EE4;"  >
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">

        <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php  echo $id ?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Product Name</label>
    <input type="text" class="form-control" name="product_name" value=" <?php echo  $name ?>">
  </div>
  <div class="mb-2">
        <label class="form-label text-white">Price</label>
        <input type="number" step="0.01" class="form-control" name="price" value="<?php echo isset($price) ? $price : ''; ?>" required>
    </div>

    <!-- 4. إضافة حقل الوصف -->
    <div class="mb-2">
        <label class="form-label text-white">Description</label>
        <input type="text" class="form-control" name="description" value="<?php echo isset($description) ? $description : ''; ?>" required>
    </div>

    <!-- 5. إضافة حقل الكمية المتاحة -->
    <div class="mb-2">
        <label class="form-label text-white">Available Quantity</label>
        <input type="number" class="form-control" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>" required>
    </div>

    <!-- 6. إضافة حقل رقم الفئة -->
    <div class="mb-2">
        <label class="form-label text-white">Category ID</label>
        <input type="number" class="form-control" name="cat_id" value="<?php echo isset($cat_id) ? $cat_id : ''; ?>" required>
    </div>


  <div class="text-center ">
  <button type="submit" class="btn  "style=" background-color:#FAF7FF; color:#854EE4;" name="btn" >update</button>
</div>
</form>
          
            
        </div>
    </div>
</div>


    
  



  <?php
include('../shared/close.php');


?>