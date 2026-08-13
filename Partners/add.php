<?php
include '../shared/database.php';

if (!isset($conn) && isset($db)) { $conn = $db; }
if (!isset($conn) && isset($con)) { $conn = $con; }

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['partner_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (isset($conn) && $conn) {
        $nameEsc   = $conn->real_escape_string($name);
        $emailEsc  = $conn->real_escape_string($email);
        $phoneEsc  = $conn->real_escape_string($phone);

        $sql = "INSERT INTO `partners` (`name`, `email`, `phone`) VALUES ('$nameEsc', '$emailEsc', '$phoneEsc')";

        if ($conn->query($sql) === TRUE) {
            header("Location: list.php");
            exit();
        } else {
            $error = "Database Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../shared/nav.php'; ?>

    <div class="container mt-4">
        <h2 class="text-primary font-weight-bold">👤+ Add New Partner</h2>
        <p class="subtitle text-muted mb-4">Fill in the information to add a new partner.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card p-4 shadow-sm border-0">
            <form action="add.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" class="form-control" name="partner_name" placeholder="Enter full name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter phone number">
                    </div>
                </div>

                <div class="d-flex justify-content-start gap-2 mt-4">
                    <a href="list.php" class="btn btn-light border">Cancel</a>
                    <button type="submit" class="btn btn-primary">👤+ Add Partner</button>
                    <a href="list.php" class="btn btn-outline-primary">📑 View List</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>