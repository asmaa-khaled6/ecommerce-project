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
            $InsertQuery = "INSERT INTO clients (name, address, email, password, gender, age, phone) 
                            VALUES ('$name', '$address', '$email', '$password', '$gender', '$age', '$phone')";
  $result = mysqli_query($conn, $InsertQuery);

if ($result) {
    $successmessage = "Client added Successfully";
} else {
    $errormessage = "Client Failed: " . mysqli_error($conn);
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
<div class="your-class" style="background-color: #F5F6FA;">
<div class="container py-5">
  <div class="row justify-content-center">

    <!-- Title -->
    


    <!-- Form Card -->
    <div class="card shadow-sm  border rounded-4 p-4 p-md-5 col-9 ">

    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="color:#17365D;">
         
          <i class="bi bi-person"style="color:#2F8FEF;" ></i> 
            
           Add New Client
           
        </h2>

        <p class="text-muted fs-4">
            Fill in the information to add a new client.
        </p>


  <div class="text-end  mt-1">
        <a href="list.php"
           class="btn px-3 py-1 rounded-5"
           style="background-color:#2F8FEF; color:white; font-size:18px;">
            View all
            <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    </div>

        <?php include('../shared/alert.php'); ?>

        <form action="" method="POST">

            <div class="row g-4">

                <!-- Left Column -->
                <div class="col-md-6">

                    <!-- Client Name -->
                    <div class="mb-3">
                        <label class="form-label fs-5">
                            Full Name
                        </label>

                        <input type="text"
                               class="form-control"
                               name="client_name"
                               placeholder="Enter full name">
                    </div>


                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fs-5">
                            Email
                        </label>

                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="Enter email address">
                    </div>


                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label fs-5 ">
                       
                            Phone
                        </label>

                        <input type="text"
                               class="form-control"
                               name="phone"
                               placeholder="Enter phone number">
                    </div>


                    <!-- Address -->
                    <div class="mb-3">
                        <label class="form-label fs-5">
                            Address
                        </label>

                        <input type="text"
                               class="form-control"
                               name="address"
                               placeholder="Enter address">
                    </div>


                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fs-5">
                            Password
                        </label>

                        <div class="position-relative">
        <input type="password"
               class="form-control pe-5"
               name="password"
               id="password"
               placeholder="Enter password">

        <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3"
           id="togglePassword"
           style="cursor: pointer;"></i>
    </div>
                    </div>

                </div>


                <!-- Right Column -->
                <div class="col-md-6">

                    <!-- Age -->
                    <div class="mb-3">
                        <label class="form-label fs-5">
                            Age
                        </label>

                        <input type="number"
                               class="form-control"
                               name="age"
                               placeholder="Enter age">
                    </div>


                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label fs-5">
                            Gender
                        </label>

                        <select class="form-select" name="gender">

                            <option selected disabled>
                                Select gender
                            </option>

                            <option value="Male">
                                Male
                            </option>

                            <option value="Female">
                                Female
                            </option>

                        </select>
                    </div>


                    


                  
                   

                </div>

            </div>


            <!-- Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-3">

                <a href="list.php"
                   class="btn  px-4 btn-light border ">
                    Cancel
                </a>

                <button type="submit"
                        name="btn"
                        class="btn add-client-btn px-4 border  text-white" style="background-color:#2F8FEF;">

                    <i class="bi bi-person-plus"></i>
                    Add Client

                </button>

            </div>

        </form>

    </div>
    </div>

</div>
</div>


  <?php
include('../shared/close.php');


?>
