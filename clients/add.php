<?php

include('../shared/database.php');
//add new category========================
$successmessage="";
 $errormessage="";
if(isset($_POST['btn'])){
    $name=$_POST['client_name'];
    $phone=$_POST['phone'];
      $address=$_POST['address'];
        $email=$_POST['email'];
          $password=$_POST['password'];
           $gender=$_POST['gender'];
            $age=$_POST['age'];

       

    try{

    if(strlen($name)<=3){
         $errormessage=" Client Name Should be Greater Than 3 Character";
    }else if(strlen($name)>20){
  $errormessage=" Client Name Should be Less Than 20 Character";
    }else{

   // تحديد أسماء الأعمدة لمنع تداخل البيانات
            $InsertQuery = "INSERT INTO clients (name, address, email, Passva, gender, age, phone) 
                            VALUES ('$name', '$address', '$email', '$password', '$gender', '$age', '$phone')";
    $result=mysqli_query($conn, $InsertQuery);
$successmessage=" client added Successfully";

    }
    }catch( Exception $e){

 $errormessage=" Client Failed".$e->getMessage();
  
 
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

   

           
          <h1  class=" py-2 text-center"style=" color:#854EE4;">Add New Client </h1>
            
        </div>
    </div>
</div>

<div class="container py-5 col-6"style=" background-color:#854EE4;"  >
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">

        <form action="" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Client Name</label>
    <input type="text" class="form-control" name="client_name">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white">address</label>
    <input type="text" class="form-control" name="address">
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Email</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Gender</label>
    <input type="text" class="form-control" name="gender">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Age</label>
    <input type="number" class="form-control" name="age">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> phone</label>
    <input type="text" class="form-control" name="phone">
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