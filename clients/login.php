<?php

session_start();

include('../shared/database.php');

$errormessage = "";

if (isset($_POST['btn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM clients
              WHERE email='$email'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (!$result) {

        die("Query Error: " . mysqli_error($conn));

    }

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // ================= Save User Data in Session =================

        $_SESSION['user_id'] = $user['id'];

        // اسم المستخدم
        $_SESSION['name'] = $user['name'];

        $_SESSION['email'] = $user['email'];

        // Role: user / admin
        $_SESSION['role'] = $user['role'];


        // ================= Redirect =================

        header("Location: ../index.php");
        exit;

    } else {

        $errormessage = "Invalid Email or Password";

    }
}

?>

<?php
include('../shared/open.php');
?>

<div style="background-color:#F5F6FA; min-height:100vh;">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="card shadow-sm border rounded-4 p-4 p-md-5 col-10 col-md-6">

                <!-- ================= Title ================= -->

                <div class="text-center mb-4">

                    <h2 class="fw-bold" style="color:#17365D;">

                        <i
                            class="bi bi-box-arrow-in-right"
                            style="color:#2F8FEF;"
                        ></i>

                        Login

                    </h2>

                    <p class="text-muted fs-5">
                        Login to your account
                    </p>

                </div>


                <!-- ================= Error Message ================= -->

                <?php if ($errormessage != "") { ?>

                    <div class="alert alert-danger">

                        <?php echo $errormessage; ?>

                    </div>

                <?php } ?>


                <!-- ================= Login Form ================= -->

                <form action="" method="POST">

                    <!-- Email -->

                    <div class="mb-4">

                        <label class="form-label fs-5">
                            Email
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            placeholder="Enter your email"
                            required
                        >

                    </div>


                    <!-- Password -->

                    <div class="mb-4">

                        <label class="form-label fs-5">
                            Password
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                    </div>


                    <!-- Login Button -->

                    <div class="d-flex justify-content-center">

                        <button
                            type="submit"
                            name="btn"
                            class="btn px-5 text-white"
                            style="background-color:#2F8FEF;"
                        >

                            <i class="bi bi-box-arrow-in-right"></i>

                            Login

                        </button>

                    </div>

                </form>


                <!-- ================= Signup ================= -->

                <div class="text-center mt-4">

                    <span class="text-muted">
                        Don't have an account?
                    </span>

                    <a
                        href="signup.php"
                        style="color:#2F8FEF; text-decoration:none;"
                    >

                        Sign Up

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include('../shared/close.php');
?>