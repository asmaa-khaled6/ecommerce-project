<?php

include('../shared/database.php');
//add new category========================
$successmessage="";
 $errormessage="";
if(isset($_POST['btn'])){
    $name=$_POST['cat_name'];
    try{

    if(strlen($name)<=3){
         $errormessage=" Category Name Should be Greater Than 3 Character";
    }else if(strlen($name)>20){
  $errormessage=" Category Name Should be Less Than 20 Character";
    }else{

    $InsertQuery=" INSERT INTO categories VALUES (NULL,'$name')";
    $result=mysqli_query($conn, $InsertQuery);
$successmessage=" Category added Successfully";

    }
    }catch( Exception $e){

 $errormessage=" Category Failed".$e->getMessage();
  
 
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

   

           
          <h1  class=" py-2 text-center"style=" color:#854EE4;">Add New Category </h1>
            
        </div>
    </div>
</div>

<div class="container py-5 col-6"style=" background-color:#854EE4;"  >
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">

        <form action="" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Category Name</label>
    <input type="text" class="form-control" name="cat_name">
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