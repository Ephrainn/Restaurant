<?php
// api/save_order.php
header('Content-Type: application/json');
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = JSON_decode(file_get_contents('php://input'), true);

    if (!$data) {
        echo JSON_encode(['success' => false, 'message' => 'Invalid data']);
        exit;
    }

    $name = $data['name'];
    $phone = $data['phone'];
    $address = $data['address'];
    $total = $data['total'];
    $items = $data['items'];
    $email = $data['email'] ?? 'not_provided@example.com';

    try {
        $pdo->beginTransaction();

        // 1. Insert Order
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, email, phone, address, total_amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $address, $total]);
        $order_id = $pdo->lastInsertId();

        // 2. Insert Items
        $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, name, price, quantity) VALUES (?, ?, ?, ?, ?)");
        foreach ($items as $item) {
            $stmtItem->execute([
                $order_id,
                $item['id'],
                $item['name'],
                $item['price'],
                $item['quantity']
            ]);
        }

        $pdo->commit();
        echo JSON_encode(['success' => true, 'order_id' => $order_id]);
    }
    catch (Exception $e) {
        $pdo->rollBack();
        echo JSON_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
else {
    echo JSON_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>
