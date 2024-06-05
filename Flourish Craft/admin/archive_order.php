<?php
include_once "../db.php";

$data = json_decode(file_get_contents('php://input'), true);
$orderId = $data['order_id'];

$sql = "UPDATE `order` SET archived = TRUE WHERE Order_ID = $orderId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$conn->close();
?>
