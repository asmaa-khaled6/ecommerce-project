<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";

if (isset($_POST['btn'])) {

    $name = $_POST['employee_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    try {

        if (strlen($name) <= 3) {

            $errormessage = "Employee Name Should be Greater Than 3 Character";

        } elseif (strlen($name) > 20) {

            $errormessage = "Employee Name Should be Less Than 20 Character";

        } else {

            $InsertQuery = "INSERT INTO employees (name, email, age, gender, password,address,phone)
                            VALUES ('$name', '$email', '$age', '$gender', '$password','$address','$phone')";

            $result = mysqli_query($conn, $InsertQuery);

            $successmessage = "Employee Added Successfully";
        }

    } catch (Exception $e) {

        $errormessage = "Employee Failed " . $e->getMessage();
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

            <div class="mb-4">
                <div class="d-flex align-items-center">
                    <div class="iconsocial rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 45px; height: 45px; background-color:#E8F0FE; color:#17365D;">
                        <i class="bi bi-person-plus" style="font-size: 1.5rem;"></i>
                    </div>
                    <h1 class="py-2 mb-0 ms-2" style="color: #17365D; font-size: 1.75rem;">Add New Employee</h1>
                </div>
                <p class="text-muted mb-0 ms-1">Fill in the information to add a new employee.</p>
            </div>

            <div class="card p-4 shadow-sm border-0">

                <form action="" method="POST">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label"> Full Name</label>
                            <input type="text" class="form-control" name="employee_name" placeholder="Enter full name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" name="age" placeholder="Enter age">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email address">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender">
                                <option selected disabled>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 position-relative">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordField" name="password" placeholder="Enter password">
                            <i class="bi bi-eye position-absolute" style="top: 42px; right: 15px; cursor: pointer;" onclick="togglePassword()"></i>
                        </div>
<div class="col-md-6 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter your address">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter your phone">
                        </div>
                    </div>
<div class="d-flex justify-content-end mt-3 pe-2">
    <button type="button" class="btn btn-light border me-2">Cancel</button>
    <button type="submit" class="btn btn-primary me-2" name="btn">
        <i class="bi bi-person-plus"></i> Add Employee
    </button>
 <a href="/nti/FinalProject/ecommerce-project/Employee/list.php"
   class="btn btn-primary border">
    <i class="bi bi-person-lines-fill"></i>
    View List
</a>
</div>

                </form>

            </div>

        </div>
    </div>

</div>

<script>
function togglePassword() {
    const field = document.getElementById('passwordField');
    field.type = field.type === 'password' ? 'text' : 'password';
}
</script>

<?php
include('../shared/close.php');
?>