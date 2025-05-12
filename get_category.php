<?php
require_once 'config.php';

// Get category slug from request
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Prepare SQL query based on category
$sql = "SELECT m.* FROM menu_items m 
        JOIN categories c ON m.category_id = c.id";
if ($category !== 'all') {
    $sql .= " WHERE c.slug = ?";
}
$stmt = $pdo->prepare($sql);
$stmt->execute($category !== 'all' ? [$category] : []);


// Fetch and return menu items as JSON
$menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($menuItems);
?>
