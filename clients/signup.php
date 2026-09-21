<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";

if (isset($_POST['btn'])) {

    $name = $_POST['client_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $role = $_POST['role'];

    try {

        if (strlen($name) <= 3) {

            $errormessage = "Client Name Should be Greater Than 3 Characters";

        } elseif (strlen($name) > 20) {

            $errormessage = "Client Name Should be Less Than 20 Characters";

        } else {

            // Check if email already exists
            $checkQuery = "SELECT * FROM clients WHERE email='$email'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {

                $errormessage = "Email already exists";

            } else {

                // Insert new client
                $InsertQuery = "INSERT INTO clients
                (name, address, email, password, gender, age, phone, role)
                VALUES
                ('$name', '$address', '$email', '$password', '$gender', '$age', '$phone', '$role')";

                $result = mysqli_query($conn, $InsertQuery);

               if ($result) {

    // Start session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Save account data in session
    $_SESSION['user_id'] = mysqli_insert_id($conn);
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;

    // Go to home page
    header("Location: ../index.php");
    exit;
}

                 else {

                    $errormessage = "Registration Failed: " . mysqli_error($conn);
                }
            }
        }

    } catch (Exception $e) {

        $errormessage = "Registration Failed: " . $e->getMessage();
    }
}

?>

<?php
include('../shared/open.php');
?>

<div style="background-color:#F5F6FA; min-height:100vh;">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="card shadow-sm border rounded-4 p-4 p-md-5 col-10 col-md-8">

                <div class="text-center mb-4">

                    <h2 class="fw-bold" style="color:#17365D;">
                        <i class="bi bi-person-plus-fill"
                           style="color:#2F8FEF;"></i>

                        Create Account
                    </h2>

                    <p class="text-muted fs-5">
                        Create your account and choose your account type.
                    </p>

                </div>

                <?php include('../shared/alert.php'); ?>

                <form action="" method="POST">

                    <div class="row g-4">

                        <!-- Name -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Full Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="client_name"
                                   placeholder="Enter full name"
                                   required>

                        </div>


                        <!-- Email -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Email
                            </label>

                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   placeholder="Enter email address"
                                   required>

                        </div>


                        <!-- Password -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Password
                            </label>

                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   placeholder="Enter password"
                                   required>

                        </div>


                        <!-- Phone -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Phone
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="phone"
                                   placeholder="Enter phone number"
                                   required>

                        </div>


                        <!-- Address -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Address
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="address"
                                   placeholder="Enter address"
                                   required>

                        </div>


                        <!-- Age -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Age
                            </label>

                            <input type="number"
                                   class="form-control"
                                   name="age"
                                   placeholder="Enter age"
                                   required>

                        </div>


                        <!-- Gender -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Gender
                            </label>

                            <select class="form-select"
                                    name="gender"
                                    required>

                                <option value="" selected disabled>
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


                        <!-- Role -->
                        <div class="col-md-6">

                            <label class="form-label fs-5">
                                Account Type
                            </label>

                            <select class="form-select"
                                    name="role"
                                    required>

                                <option value="" selected disabled>
                                    Select account type
                                </option>

                                <option value="user">
                                    User
                                </option>

                                <option value="admin">
                                    Admin
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- Button -->
                    <div class="d-flex justify-content-center mt-4">

                        <button type="submit"
                                name="btn"
                                class="btn px-5 text-white"
                                style="background-color:#2F8FEF;">

                            <i class="bi bi-person-plus"></i>

                            Create Account

                        </button>

                    </div>

                </form>


                <div class="text-center mt-4">

                    <span class="text-muted">
                        Already have an account?
                    </span>

                    <a href="login.php"
                       style="color:#2F8FEF; text-decoration:none;">

                        Login

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include('../shared/close.php');
?>