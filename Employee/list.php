<?php

include('../shared/database.php');

$successmessage = "";
$errormessage = "";

// Delete Employee
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    try{

        $deletequery = "DELETE FROM employees WHERE id=$id";
        $deleteresult = mysqli_query($conn, $deletequery);

        if($deleteresult){
            $successmessage = "Deleted Successfully";
        }else{
            $errormessage = "Can Not Deleted";
        }

    }catch(Exception $e){

    }
}

// All Employees
$employeesquery = "SELECT * FROM employees";
$employees = mysqli_query($conn, $employeesquery);

?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>

<div class="container py-5">

    <?php include('../shared/alert.php'); ?>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="clients-title">
                <i class="bi bi-person-badge-fill"></i>
                List ALL Employees
            </h1>

            <p class="clients-subtitle">
                Here are all the employees registered in the system.
            </p>
        </div>

        <a href="./add.php" class="add-client-btn px-2 border rounded-5">
            <i class="bi bi-plus-lg"></i>
            Add Employee
        </a>

    </div>


    <!-- Employees Table Card -->
    <div class="clients-card border">

        <!-- Table -->
        <div class="table-responsive">

            <table class="table clients-table align-middle">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>EMPLOYEE</th>
                        <th>EMAIL</th>
                        <th>ADDRESS</th>
                        <th>PASSWORD</th>
                        <th>GENDER</th>
                        <th>AGE</th>
                        <th>PHONE</th>
                        <th>ACTIONS</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($employees as $item){ ?>

                    <tr>

                        <!-- ID -->
                        <td>
                            <span class="client-id">
                                <?php echo $item['id']; ?>
                            </span>
                        </td>


                        <!-- Employee -->
                        <td>

                            <div class="client-name">

                                <div class="client-avatar">
                                    <?php echo strtoupper(substr($item['name'],0,1)); ?>
                                </div>

                                <span>
                                    <?php echo $item['name']; ?>
                                </span>

                            </div>

                        </td>


                        <!-- Email -->
                        <td>
                            <?php echo $item['email']; ?>
                        </td>


                        <!-- Address -->
                        <td>

                            <i class="bi bi-geo-alt location-icon"></i>

                            <?php echo $item['address']; ?>

                        </td>


                        <!-- Password -->
                        <td>

                            <span class="password-text">
                                <?php echo $item['password']; ?>
                            </span>

                        </td>


                        <!-- Gender -->
                        <td>

                            <span class="gender-badge">
                                <?php echo $item['gender']; ?>
                            </span>

                        </td>


                        <!-- Age -->
                        <td>
                            <?php echo $item['age']; ?>
                        </td>


                        <!-- Phone -->
                        <td>
                            <?php echo $item['phone']; ?>
                        </td>


                        <!-- Actions -->
                        <td>

                            <a
                                href="./edit.php?edit=<?php echo $item['id']; ?>"
                                class="action-edit"
                                title="Edit">

                                <i class="bi bi-pencil-square"></i>

                            </a>


                            <a
                                href="./list.php?delete=<?php echo $item['id']; ?>"
                                class="action-delete"
                                title="Delete">

                                <i class="bi bi-trash3"></i>

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php
include('../shared/close.php');
?>