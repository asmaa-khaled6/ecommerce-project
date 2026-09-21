<?php

include('../shared/permissions.php');

include('../shared/database.php');

$successmessage = "";
$errormessage = "";


// ================= Delete Client =================

if (isAdmin() && isset($_GET['delete'])) {

    $id = intval($_GET['delete']);

    try {

        $deletequey = "DELETE FROM clients WHERE id=$id";

        $deleteresult = mysqli_query($conn, $deletequey);

        if ($deleteresult) {

            $successmessage = "Deleted Successfully";

        } else {

            $errormessage = "Can Not Deleted";

        }

    } catch (Exception $e) {

        $errormessage = "Can Not Deleted";
    }
}


// ================= All Clients =================

$clientsquery = "SELECT * FROM clients";

$clients = mysqli_query($conn, $clientsquery);

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

                <i class="bi bi-people-fill"></i>

                List ALL Clients

            </h1>


            <p class="clients-subtitle">

                Here are all the clients registered in the system.

            </p>

        </div>


        <!-- Add Client - Admin Only -->

        <?php if (isAdmin()) { ?>

            <a
                href="./add.php"
                class="add-client-btn px-2 border rounded-5"
            >

                <i class="bi bi-plus-lg"></i>

                Add Client

            </a>

        <?php } ?>


    </div>


    <!-- Clients Table Card -->

    <div class="clients-card border">


        <!-- Table -->

        <div class="table-responsive">


            <table class="table clients-table align-middle">


                <thead>

                    <tr>

                        <th>ID</th>

                        <th>CLIENT</th>

                        <th>EMAIL</th>

                        <th>ADDRESS</th>

                        <th>PASSWORD</th>

                        <th>GENDER</th>

                        <th>AGE</th>

                        <th>PHONE</th>


                        <!-- Actions only for Admin -->

                        <?php if (isAdmin()) { ?>

                            <th>ACTIONS</th>

                        <?php } ?>

                    </tr>

                </thead>


                <tbody>


                <?php foreach ($clients as $item) { ?>


                    <tr>


                        <td>

                            <span class="client-id">

                                <?php echo $item['id']; ?>

                            </span>

                        </td>


                        <td>

                            <div class="client-name">

                                <div class="client-avatar">

                                    <?php
                                    echo strtoupper(
                                        substr($item['name'], 0, 1)
                                    );
                                    ?>

                                </div>


                                <span>

                                    <?php echo $item['name']; ?>

                                </span>

                            </div>

                        </td>


                        <td>

                            <?php echo $item['email']; ?>

                        </td>


                        <td>

                            <i class="bi bi-geo-alt location-icon"></i>

                            <?php echo $item['address']; ?>

                        </td>


                        <td>

                            <span class="password-text">

                                <?php echo $item['password']; ?>

                            </span>

                        </td>


                        <td>

                            <span class="gender-badge">

                                <?php echo $item['gender']; ?>

                            </span>

                        </td>


                        <td>

                            <?php echo $item['age']; ?>

                        </td>


                        <td>

                            <?php echo $item['phone']; ?>

                        </td>


                        <!-- Admin Actions -->

                        <?php if (isAdmin()) { ?>

                            <td>


                                <!-- Edit -->

                                <a
                                    href="./edit.php?edit=<?php echo $item['id']; ?>"
                                    class="action-edit"
                                    title="Edit"
                                >

                                    <i class="bi bi-pencil-square"></i>

                                </a>


                                <!-- Delete -->

                                <a
                                    href="./list.php?delete=<?php echo $item['id']; ?>"
                                    class="action-delete"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this client?');"
                                >

                                    <i class="bi bi-trash3"></i>

                                </a>


                            </td>

                        <?php } ?>


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