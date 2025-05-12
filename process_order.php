<?php
require_once 'config.php'; // Ensure database connection is established

session_start();

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
$missingFields = [];
if (!isset($data['tableNumber'])) $missingFields[] = 'tableNumber';
if (!isset($data['paymentMethod'])) $missingFields[] = 'paymentMethod';
if (!isset($data['items'])) $missingFields[] = 'items';
if (!isset($data['total'])) $missingFields[] = 'total';

if (!empty($missingFields)) {
    echo json_encode([
        'success' => false,
        'error' => 'Missing required fields: ' . implode(', ', $missingFields)
    ]);
    exit;
}

try {
    // Start transaction
    $pdo->beginTransaction();
    
    // Insert order
    $stmt = $pdo->prepare("INSERT INTO orders (user_email, table_number, instructions, payment_method, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['email'],
        intval($data['tableNumber']),
        $data['instructions'] ?? '',
        $data['paymentMethod'],
        floatval($data['total'])
    ]);
    
    $orderId = $pdo->lastInsertId();
    
    // Insert order items
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($data['items'] as $item) {
        if (!isset($item['id']) || !isset($item['quantity']) || !isset($item['price'])) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'error' => 'Invalid item data']);
            exit;
        }
        $stmt->execute([
            $orderId,
            intval($item['id']),
            intval($item['quantity']),
            floatval($item['price'])
        ]);
    }
    
    // Commit transaction
    // Commit transaction
    $pdo->commit();
    
    header('Location: orders.php'); // Redirect to My Orders page
    echo json_encode(['success' => true]);


    $pdo->commit();
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
