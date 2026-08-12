<?php

include('../shared/database.php');

// ======================== Edit Client ========================
$successmessage = "";
$errormessage = "";

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $clientquery = "SELECT * FROM clients WHERE id = $id";
    $oldclient = mysqli_query($conn, $clientquery);

    if (mysqli_num_rows($oldclient) > 0) {

        $client = mysqli_fetch_assoc($oldclient);

        $name = $client['name'];
        $address = $client['address'];
        $email = $client['email'];
        $password = $client['password'];
        $gender = $client['gender'];
        $age = $client['age'];
        $phone = $client['phone'];
    }
}


// ======================== Update Client ========================
if (isset($_POST['btn'])) {

    $id = $_GET['edit'];

    $name = $_POST['client_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    try {

        if (strlen($name) <= 3) {

            $errormessage = "Client Name Should be Greater Than 3 Character";

        } else if (strlen($name) > 20) {

            $errormessage = "Client Name Should be Less Than 20 Character";

        } else {

            $updatequery = "UPDATE clients SET 
                            name = '$name',
                            address = '$address',
                            email = '$email',
                            password = '$password',
                            gender = '$gender',
                            age = '$age',
                            phone = '$phone'
                            WHERE id = $id";

            $updateresult = mysqli_query($conn, $updatequery);

            if ($updateresult) {

                $successmessage = "Client updated successfully";

            } else {

                $errormessage = "Failed to update client: " . mysqli_error($conn);
            }
        }

    } catch (Exception $e) {

        $errormessage = "Client Failed: " . $e->getMessage();
    }
}

?>

<!-- ====================== HTML ====================== -->

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>

<div class="your-class" style="background-color: #F5F6FA;">

    <div class="container py-5">

        <div class="row justify-content-center">

            <!-- Form Card -->
            <div class="card shadow-sm border rounded-4 p-4 p-md-5 col-9">

                <!-- Header -->
                <div class="mb-4">

                    <h2 class="fw-bold mb-1" style="color:#17365D;">

                        <i class="bi bi-person" style="color:#2F8FEF;"></i>

                        Edit Client

                    </h2>

                    <p class="text-muted fs-4">
                        Update the client information.
                    </p>

                    <div class="text-end mt-1">

                        <a href="list.php"
                           class="btn px-3 py-1 rounded-5"
                           style="background-color:#2F8FEF; color:white; font-size:18px;">

                            View all

                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>

                </div>


                <!-- Alert -->
                <?php include('../shared/alert.php'); ?>


                <!-- Form -->
                <form action="" method="POST">

                    <div class="row g-4">


                        <!-- ================= Left Column ================= -->

                        <div class="col-md-6">


                            <!-- Client Name -->
                            <div class="mb-3">

                                <label class="form-label fs-5">
                                    Full Name
                                </label>

                                <input type="text"
                                       class="form-control"
                                       name="client_name"
                                       value="<?php echo htmlspecialchars($name ?? ''); ?>"
                                       placeholder="Enter full name"
                                       required>

                            </div>


                            <!-- Email -->
                            <div class="mb-3">

                                <label class="form-label fs-5">
                                    Email
                                </label>

                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="<?php echo htmlspecialchars($email ?? ''); ?>"
                                       placeholder="Enter email address"
                                       required>

                            </div>


                            <!-- Phone -->
                            <div class="mb-3">

                                <label class="form-label fs-5">
                                    Phone
                                </label>

                                <input type="text"
                                       class="form-control"
                                       name="phone"
                                       value="<?php echo htmlspecialchars($phone ?? ''); ?>"
                                       placeholder="Enter phone number"
                                       required>

                            </div>


                            <!-- Address -->
                            <div class="mb-3">

                                <label class="form-label fs-5">
                                    Address
                                </label>

                                <input type="text"
                                       class="form-control"
                                       name="address"
                                       value="<?php echo htmlspecialchars($address ?? ''); ?>"
                                       placeholder="Enter address"
                                       required>

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
                                           value="<?php echo htmlspecialchars($password ?? ''); ?>"
                                           placeholder="Enter password"
                                           required>

                                    <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3"
                                       id="togglePassword"
                                       style="cursor: pointer;">
                                    </i>

                                </div>

                            </div>

                        </div>


                        <!-- ================= Right Column ================= -->

                        <div class="col-md-6">


                            <!-- Age -->
                            <div class="mb-3">

                                <label class="form-label fs-5">
                                    Age
                                </label>

                                <input type="number"
                                       class="form-control"
                                       name="age"
                                       value="<?php echo htmlspecialchars($age ?? ''); ?>"
                                       placeholder="Enter age"
                                       required>

                            </div>


                            <!-- Gender -->
                            <div class="mb-3">

                                <label class="form-label fs-5">
                                    Gender
                                </label>

                                <select class="form-select" name="gender" required>

                                    <option value="" disabled>
                                        Select gender
                                    </option>

                                    <option value="Male"
                                        <?php if (($gender ?? '') == 'Male') echo 'selected'; ?>>
                                        Male
                                    </option>

                                    <option value="Female"
                                        <?php if (($gender ?? '') == 'Female') echo 'selected'; ?>>
                                        Female
                                    </option>

                                </select>

                            </div>


                        </div>

                    </div>


                    <!-- ================= Buttons ================= -->

                    <div class="d-flex justify-content-end gap-2 mt-3">

                        <a href="list.php"
                           class="btn px-4 btn-light border">

                            Cancel

                        </a>

                        <button type="submit"
                                name="btn"
                                class="btn add-client-btn px-4 border text-white"
                                style="background-color:#2F8FEF;">

                            <i class="bi bi-person-check"></i>

                            Update Client

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