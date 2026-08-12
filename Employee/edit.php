<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";

$id = "";
$name = "";
$email = "";
$password = "";
$gender = "";
$age = "";
$address = "";
$phone = "";


// Get Employee Data
if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $employeesquery = "SELECT * FROM employees WHERE id=$id";
    $oldemployees = mysqli_query($conn, $employeesquery);

    if (mysqli_num_rows($oldemployees) > 0) {

        $employee = mysqli_fetch_assoc($oldemployees);

        $name = $employee['name'];
        $email = $employee['email'];
        $password = $employee['password'];
        $gender = $employee['gender'];
        $age = $employee['age'];
        $address = $employee['address'];
        $phone = $employee['phone'];

    } else {

        $errormessage = "Employee Not Found";
    }
}


// Update Employee
if (isset($_POST['btn'])) {

    $id = $_GET['edit'];

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

            $updatequery = "UPDATE employees SET
                            name='$name',
                            email='$email',
                            age='$age',
                            gender='$gender',
                            password='$password',
                            address='$address',
                            phone='$phone'
                            WHERE id=$id";

            $updateresult = mysqli_query($conn, $updatequery);

            if ($updateresult) {

                $successmessage = "Employee Updated Successfully";

            } else {

                $errormessage = "Employee Update Failed";
            }
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

                        <i class="bi bi-person-gear" style="font-size: 1.5rem;"></i>

                    </div>

                    <h1 class="py-2 mb-0 ms-2"
                        style="color: #17365D; font-size: 1.75rem;">

                        Update Employee

                    </h1>

                </div>

                <p class="text-muted mb-0 ms-1">
                    Update the employee information.
                </p>

            </div>


            <div class="card p-4 shadow-sm border-0">


                <form action="" method="POST">

                    <div class="row">


                        <!-- Full Name -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="employee_name"
                                value="<?php echo $name; ?>"
                                placeholder="Enter full name"
                            >

                        </div>


                        <!-- Age -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Age
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="age"
                                value="<?php echo $age; ?>"
                                placeholder="Enter age"
                            >

                        </div>


                        <!-- Email -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="<?php echo $email; ?>"
                                placeholder="Enter email address"
                            >

                        </div>


                        <!-- Gender -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Gender
                            </label>

                            <select class="form-select" name="gender">

                                <option value="Male"
                                    <?php if ($gender == "Male") echo "selected"; ?>>
                                    Male
                                </option>

                                <option value="Female"
                                    <?php if ($gender == "Female") echo "selected"; ?>>
                                    Female
                                </option>

                            </select>

                        </div>


                        <!-- Password -->

                        <div class="col-md-6 mb-3 position-relative">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="passwordField"
                                name="password"
                                value="<?php echo $password; ?>"
                                placeholder="Enter password"
                            >

                            <i
                                class="bi bi-eye position-absolute"
                                style="top: 42px; right: 15px; cursor: pointer;"
                                onclick="togglePassword()">
                            </i>

                        </div>


                        <!-- Address -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="address"
                                value="<?php echo $address; ?>"
                                placeholder="Enter your address"
                            >

                        </div>


                        <!-- Phone -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Phone
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="phone"
                                value="<?php echo $phone; ?>"
                                placeholder="Enter your phone"
                            >

                        </div>


                    </div>


                    <!-- Buttons -->

                    <div class="d-flex justify-content-end mt-3 pe-2">

                        <button
                            type="button"
                            class="btn btn-light border me-2">
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary me-2"
                            name="btn">

                            <i class="bi bi-person-check"></i>
                            Update Employee

                        </button>


                        <a
                            href="/nti/FinalProject/ecommerce-project/Employee/list.php"
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

    field.type =
        field.type === 'password'
        ? 'text'
        : 'password';

}

</script>


<?php
include('../shared/close.php');
?>