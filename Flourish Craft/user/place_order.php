<?php
session_start();
include_once "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['customers_username'], $_POST['set_id'], $_POST['variation'], $_POST['quantity'], $_POST['total_price'], $_POST['delivery_date'], $_POST['payment_method'], $_POST['delivery_method'])) {
        $username = $_SESSION['customers_username'];
        $setId = $_POST['set_id'];
        $variation = $_POST['variation'];
        $quantity = $_POST['quantity'];
        $totalPrice = $_POST['total_price'];
        $deliveryDate = $_POST['delivery_date'];
        $paymentMethod = $_POST['payment_method'];
        $deliveryMethod = $_POST['delivery_method'];
        $accountName = isset($_POST['account_name']) ? $_POST['account_name'] : null;
        $accountNumber = isset($_POST['account_number']) ? $_POST['account_number'] : null;
        $referenceNumber = isset($_POST['reference_number']) ? $_POST['reference_number'] : null;
        $amount = isset($_POST['amount']) ? $_POST['amount'] : null;

        $stmt = $conn->prepare("SELECT Customer_ID FROM `customers` WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($customerId);
        $stmt->fetch();
        $stmt->close();

        if ($customerId) {
            $stmt = $conn->prepare("SELECT Set_Name FROM `set` WHERE Set_ID = ?");
            $stmt->bind_param("i", $setId);
            $stmt->execute();
            $stmt->bind_result($setName);
            $stmt->fetch();
            $stmt->close();

            if ($setName) {
                $stmt = $conn->prepare("INSERT INTO `order` (Customer_ID, Set_Name, Variation, Quantity, Price, Delivery_Date, mode_of_payment, mode_of_delivery) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issidsss", $customerId, $setName, $variation, $quantity, $totalPrice, $deliveryDate, $paymentMethod, $deliveryMethod);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $orderId = $stmt->insert_id;
                    $stmt->close();

                    $stmt = $conn->prepare("INSERT INTO `payment` (Order_ID, Mode_of_Payment, Account_Name, Account_Number, Reference_Number, Amount) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("issssd", $orderId, $paymentMethod, $accountName, $accountNumber, $referenceNumber, $amount);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        header("Location: user_index.php");
                        exit();
                    } else {
                        echo "Error inserting payment details. Please try again.";
                    }
                    $stmt->close();
                } else {
                    echo "Error placing order. Please try again.";
                }
            } else {
                echo "Set not found. Please try again.";
            }
        } else {
            echo "Customer not found. Please try again.";
        }
    } else {
        echo "Warning: Some data is missing. Proceeding with the order placement.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>