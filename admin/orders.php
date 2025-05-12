<?php
session_start();
require '../config.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}
// Handle payment status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
  $id = $_POST['id'];
  $payment_status = $_POST['status'];

  $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
  $stmt->execute([$payment_status, $id]);
}

// Handle form submissions for deleting users
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$id]);
}

// Get all users
$users = $pdo->query("SELECT * FROM orders")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 240px;
      background-color: #2c3e50;
      color: white;
      position: fixed;
      height: 100%;
      padding-top: 1rem;
    }
    .sidebar a {
      color: white;
      display: block;
      padding: 10px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #34495e;
    }
    .content {
      margin-left: 240px;
      padding: 1rem;
      width: 100%;
    }
    .card-box {
      color: white;
      padding: 20px;
      border-radius: 10px;
    }
    </style>
</head>
<body>
<div class="sidebar">
  <h4 class="text-center">Admin Panel</h4>
  <a href="admin.php"><i class="fa fa-home me-2"></i>Home</a>
  <a href="menuitems.php"><i class="fa fa-utensils me-2"></i> Manage Menu</a>
  <a href="review.php"><i class="fa fa-star me-2"></i> Reviews</a>
  <a href="orders.php"><i class="fa fa-shopping-cart me-2"></i> Orders</a>
  <a href="users.php"><i class="fa fa-users me-2"></i> Users</a>
  <a href="analytics.php"><i class="fa fa-chart-line me-2"></i> Analytics</a>
  
</div>
<div class="content">
    <div class="container mt-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Orders</h1>
                <a href="admin.php" class="btn btn-danger">Back</a>
            </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Table No</th>
                    <th>Instructions</th>
                    <th>Payment</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $orders): ?>

                <tr>
                    <td><?= $orders['id'] ?></td>
                    <td><?= $orders['name'] ?></td>
                    <td><?= $orders['email'] ?></td>
                    <td><?= $orders['table_no'] ?></td>
                    <td><?= $orders['instructions'] ?></td>
                    <td><?= $orders['payment_method'] ?></td>
                    <td><?= $orders['total_products'] ?></td>
                    <td><?= $orders['total_price'] ?></td>
                    <td>
    <form method="POST" class="d-flex">
        <input type="hidden" name="id" value="<?= $orders['id'] ?>">
        <select name="status" class="form-select form-select-sm me-2">
            <option value="Paid" <?= $orders['status'] === 'Paid' ? 'selected' : '' ?>>Paid</option>
            <option value="Unpaid" <?= $orders['status'] === 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
        </select>
        <button type="submit" name="update_status" class="btn btn-sm btn-success">Update</button>
    </form>
</td>
                    <td><?= $orders['created_at'] ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $orders['id'] ?>">
                            <button type="submit" name="delete_order" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
