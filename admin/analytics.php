<?php
session_start();
require '../config.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

// Get statistics
$total_users = $pdo->query("SELECT COUNT(*) FROM details")->fetchColumn();
$total_orders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$total_reviews = $pdo->query("SELECT COUNT(*) FROM review")->fetchColumn();
$total_menu_items = $pdo->query("SELECT COUNT(*) FROM menu_items")->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <a href="admin.php"><i class="fa fa-utensils me-2"></i> Manage Menu</a>
  <a href="review.php"><i class="fa fa-star me-2"></i> Reviews</a>
  <a href="orders.php"><i class="fa fa-shopping-cart me-2"></i> Orders</a>
  <a href="users.php"><i class="fa fa-users me-2"></i> Users</a>
  <a href="analytics.php"><i class="fa fa-chart-line me-2"></i> Analytics</a>
  
</div>
<div class="content">
    <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Analytics</h1>
                <a href="admin.php" class="btn btn-danger">Back</a>
            </div>
        <div class="row">
        <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?= $total_users ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total orders</h5>
                        <p class="card-text"><?= $total_orders ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Reviews</h5>
                        <p class="card-text"><?= $total_reviews ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Menu Items</h5>
                        <p class="card-text"><?= $total_menu_items ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
