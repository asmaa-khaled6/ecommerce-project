<?php

include('../shared/database.php');
//edit  category========================
$successmessage="";
 $errormessage="";
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $clientquer="SELECT * FROM clients WHERE id=$id";
    $oldclient=mysqli_query($conn,$clientquer);
    $row=mysqli_num_rows( $oldclient);
    if($row>0){
        $client=mysqli_fetch_assoc( $oldclient);
        $name= $client['name'];
      $address=$client['address'];
        $email=$client['email'];
          $password=$client['Passva'];
           $gender=$client['gender'];
            $age=$client['age'];
           $phone=$client['phone'];


    }   
}


 
if(isset($_POST['btn'])){
   
$id       = $_GET['edit'];
 $name=$_POST['client_name'];
      $address=$_POST['address'];
        $email=$_POST['email'];
          $password=$_POST['password'];
           $gender=$_POST['gender'];
            $age=$_POST['age'];
             $phone=$_POST['phone'];

    try{

    if(strlen($name)<=3){
         $errormessage=" client Name Should be Greater Than 3 Character";
    }else if(strlen($name)>20){
  $errormessage=" Client Name Should be Less Than 20 Character";
    }else{
        $updatequery="UPDATE clients SET name = '$name',
                            address = '$address',
                            email = '$email',
                            Passva = '$password',
                            gender = '$gender',
                            age = '$age',
                            phone = '$phone'
                            WHERE id = $id";
         $updateresult=mysqli_query($conn, $updatequery);
         if($updateresult){
            $successmessage=" category updated successfully";
         }else{
             $errormessage=" failed update";
         }


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

   

           
          <h1  class=" py-2 text-center"style=" color:#854EE4;">Update Client </h1>
            
        </div>
    </div>
</div>

<div class="container py-5 col-6"style=" background-color:#854EE4;"  >
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">

        <form action="" method="POST">
            <input type="hidden" name="cat_id" value="<?php  echo $id ?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white"> Client Name</label>
    <input type="text" class="form-control" name="client_name" value=" <?php echo $name ?>">
  </div>
  <div class="mb-3">
                    <label class="form-label text-white">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?? ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Password</label>
                    <input type="text" class="form-control" name="password" value="<?php echo $password ?? ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Gender</label>
                    <input type="text" class="form-control" name="gender" value="<?php echo $gender ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Age</label>
                    <input type="number" class="form-control" name="age" value="<?php echo $age ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?? ''; ?>">
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