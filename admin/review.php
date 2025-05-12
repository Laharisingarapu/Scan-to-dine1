<?php
session_start();
require '../config.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

// Handle form submissions for deleting reviews
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM review WHERE id = ?");
    $stmt->execute([$id]);
}

// Get all reviews
$reviews = $pdo->query("SELECT * FROM review")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Reviews</title>
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
        <h1>Manage Reviews</h1>
                <a href="admin.php" class="btn btn-danger">Back</a>
            </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?= $review['id'] ?></td>
                    <td><?= $review['name'] ?></td>
                    <td><?= $review['review'] ?></td>
                    <td><?= $review['description'] ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $review['id'] ?>">
                            <button type="submit" name="delete_review" class="btn btn-sm btn-danger">Delete</button>
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
