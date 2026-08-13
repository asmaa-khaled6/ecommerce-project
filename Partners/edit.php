<?php
include '../shared/database.php';

if (!isset($conn) && isset($db)) { $conn = $db; }
if (!isset($conn) && isset($con)) { $conn = $con; }

$error = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: list.php");
    exit();
}

$id = intval($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['partner_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (isset($conn) && $conn) {
        $nameEsc  = $conn->real_escape_string($name);
        $emailEsc = $conn->real_escape_string($email);
        $phoneEsc = $conn->real_escape_string($phone);

        $sqlUpdate = "UPDATE `partners` SET `name` = '$nameEsc', `email` = '$emailEsc', `phone` = '$phoneEsc' WHERE `id` = $id";

        if ($conn->query($sqlUpdate) === TRUE) {
            header("Location: list.php");
            exit();
        } else {
            $error = "Database Error: " . $conn->error;
        }
    }
}

$partner = null;
if (isset($conn) && $conn) {
    $fetchResult = $conn->query("SELECT * FROM `partners` WHERE `id` = $id");
    if ($fetchResult && $fetchResult->num_rows > 0) {
        $partner = $fetchResult->fetch_assoc();
    } else {
        header("Location: list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../shared/nav.php'; ?>

    <div class="container mt-4">
        <h2 class="text-primary font-weight-bold">✏️ Edit Partner Details</h2>
        <p class="subtitle text-muted mb-4">Update partner information.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card p-4 shadow-sm border-0">
            <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" class="form-control" name="partner_name" value="<?php echo htmlspecialchars($partner['name'] ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($partner['email'] ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($partner['phone'] ?? ''); ?>">
                    </div>
                </div>

                <div class="d-flex justify-content-start gap-2 mt-4">
                    <a href="list.php" class="btn btn-light border">Cancel</a>
                    <button type="submit" class="btn btn-primary">💾 Update Partner</button>
                    <a href="list.php" class="btn btn-outline-primary">📑 View List</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>