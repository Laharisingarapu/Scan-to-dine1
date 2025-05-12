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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Restaurant Admin Panel</title>
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

<!-- Sidebar -->
<div class="sidebar">
  <h4 class="text-center">Admin Panel</h4>
  <a href="admin.php"><i class="fa fa-home me-2"></i>Home</a>
  <a href="menuitems.php"><i class="fa fa-utensils me-2"></i> Manage Menu</a>
  <a href="review.php"><i class="fa fa-star me-2"></i> Reviews</a>
  <a href="orders.php"><i class="fa fa-shopping-cart me-2"></i> Orders</a>
  <a href="users.php"><i class="fa fa-users me-2"></i> Users</a>
  <a href="analytics.php"><i class="fa fa-chart-line me-2"></i> Analytics</a>
  
</div>

<!-- Main Content -->
<div class="content">
  <!-- Top Navbar -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Welcome, Admin</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>

  <!-- Dashboard Cards -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card bg-primary card-box">
        <h5>Total Menu Items</h5>
        <h3><?= $total_menu_items ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success card-box">
        <h5>Total Orders</h5>
        <h3><?= $total_orders ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning card-box text-dark">
        <h5>Reviews</h5>
        <h3><?= $total_reviews ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-info card-box text-dark">
        <h5>Users</h5>
        <h3><?= $total_users ?></h3>
      </div>
    </div>
  </div>


</div>

</body>
</html>
