<?php
include_once "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'];

$stmt_update_status = $conn->prepare("UPDATE `order` SET order_status = 'delivered' WHERE Order_ID = ?");
$stmt_update_status->bind_param("i", $order_id);
$stmt_update_status->execute();
$stmt_update_status->close();

$stmt_fetch_order = $conn->prepare("SELECT s.Order_ID, s.Tracking_Number, o.Set_Name, c.Name, o.Order_Date 
                                    FROM shipping s 
                                    INNER JOIN `order` o ON s.Order_ID = o.Order_ID 
                                    INNER JOIN customers c ON o.Customer_ID = c.Customer_ID
                                    WHERE o.Order_ID = ?");
$stmt_fetch_order->bind_param("i", $order_id);
$stmt_fetch_order->execute();
$result_order = $stmt_fetch_order->get_result();
$order_details = $result_order->fetch_assoc();
$stmt_fetch_order->close();

$conn->close();

echo json_encode(['status' => 'success', 'order_details' => $order_details]);
?>