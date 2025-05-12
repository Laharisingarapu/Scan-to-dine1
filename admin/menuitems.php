
<?php
session_start();
require 'config.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_item'])) {
        // Handle add menu item
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $image_url = $_POST['image_url'];

        $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, price, category_id, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $category_id, $image_url]);
    } elseif (isset($_POST['update_item'])) {
        // Handle update menu item
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $image_url = $_POST['image_url'];

        $stmt = $pdo->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, category_id = ?, image_url = ? WHERE id = ?");
        $stmt->execute([$name, $description, $price, $category_id, $image_url, $id]);
    } elseif (isset($_POST['delete_item'])) {
        // Handle delete menu item
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id = ?");
        $stmt->execute([$id]);
    }
}

// Get all menu items and categories
$menu_items = $pdo->query("SELECT * FROM menu_items")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Items</title>
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
  <a href="menuitems.php"><i class="fa fa-utensils me-2"></i> Manage Menu</a>
  <a href="review.php"><i class="fa fa-star me-2"></i> Reviews</a>
  <a href="orders.php"><i class="fa fa-shopping-cart me-2"></i> Orders</a>
  <a href="users.php"><i class="fa fa-users me-2"></i> Users</a>
  <a href="analytics.php"><i class="fa fa-chart-line me-2"></i> Analytics</a>
  
</div>
<div class="content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                
                
            </div>


        
        <!-- Add Menu Item Form -->
        <h2>Add New Menu Item</h2>
        <hr>

        <form method="POST" class="mb-5">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Price</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Image URL</label>
                <input type="text" name="image_url" class="form-control" required>
            </div>
            <button type="submit" name="add_item" class="btn btn-primary">Add Item</button>
        </form>

        <!-- Menu Items Table -->
        <h2>Manage Menu Items</h2>
        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menu_items as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $categories[array_search($item['category_id'], array_column($categories, 'id'))]['name'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">Edit</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="delete_item" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Menu Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $item['name'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" required><?= $item['description'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Price</label>
                                        <input type="number" step="0.01" name="price" class="form-control" value="<?= $item['price'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control" required>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>" <?= $category['id'] == $item['category_id'] ? 'selected' : '' ?>>
                                                    <?= $category['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Image URL</label>
                                        <input type="text" name="image_url" class="form-control" value="<?= $item['image_url'] ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="update_item" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
