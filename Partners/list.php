<?php
include '../shared/database.php';

if (!isset($conn) && isset($db)) { $conn = $db; }
if (!isset($conn) && isset($con)) { $conn = $con; }

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    if (isset($conn) && $conn) {
        $conn->query("DELETE FROM `partners` WHERE `id` = $delete_id");
        header("Location: list.php");
        exit();
    }
}

$partners = [];
if (isset($conn) && $conn) {
    $result = $conn->query("SELECT * FROM `partners` ORDER BY `id` DESC");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $partners[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partners List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../shared/nav.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="text-primary font-weight-bold mb-0">📑 Partners List</h2>
                <p class="subtitle text-muted">Manage all your registered partners</p>
            </div>
            <a href="add.php" class="btn btn-primary">👤+ Add New Partner</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($partners)): ?>
                                <?php foreach ($partners as $index => $partner): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($partner['name'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($partner['email'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($partner['phone'] ?? '-'); ?></td>
                                        <td class="text-center">
                                            <a href="edit.php?id=<?php echo $partner['id']; ?>" class="btn btn-sm btn-outline-warning me-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="list.php?delete_id=<?php echo $partner['id']; ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this partner?');">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        No partners found. Click "Add New Partner" to create one.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>