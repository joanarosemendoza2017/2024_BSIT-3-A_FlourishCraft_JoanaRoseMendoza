<?php
include_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $tracking_number = isset($_POST['tracking_number']) ? $_POST['tracking_number'] : null;

        $sql = "INSERT INTO shipping (Order_ID, Tracking_Number) VALUES (?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("is", $order_id, $tracking_number);
            if ($stmt->execute()) {
                header("Location: view_order.php?message=Shipping information recorded successfully&order_id=" . $order_id);
                exit();
            } else {
                $error = "Failed to record the shipping information.";
            }
            $stmt->close();
        } else {
            $error = "Failed to prepare the SQL statement.";
        }
    } else {
        $error = "Order ID not specified.";
    }
} elseif (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql = "SELECT payment.Payment_ID, payment.Order_ID, payment.Mode_of_Payment, payment.Account_Name, payment.Account_Number, payment.Reference_Number, payment.Amount, `order`.mode_of_delivery 
    FROM payment 
    INNER JOIN `order` ON payment.Order_ID = `order`.Order_ID
    WHERE payment.Order_ID = ?";

    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $paymentDetails = $result->fetch_assoc();
        } else {
            $error = "No payment details found for the given order ID.";
        }
        $stmt->close();
    } else {
        $error = "Failed to prepare the SQL statement.";
    }
} else {
    $error = "Order ID not specified.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Payment Details</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php else: ?>
        <form action="verify_payment.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mode of Payment</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Reference Number</th>
                        <th>Amount</th>
                        <?php if ($paymentDetails['mode_of_delivery'] !== 'pickup'): ?>
                            <th>Tracking Number</th>
                        <?php endif; ?>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($paymentDetails['Mode_of_Payment']); ?></td>
                        <td><?php echo htmlspecialchars($paymentDetails['Account_Name']); ?></td>
                        <td><?php echo htmlspecialchars($paymentDetails['Account_Number']); ?></td>
                        <td><?php echo htmlspecialchars($paymentDetails['Reference_Number']); ?></td>
                        <td><?php echo htmlspecialchars($paymentDetails['Amount']); ?></td>
                        <?php if ($paymentDetails['mode_of_delivery'] !== 'pickup'): ?>
                            <td><input type="text" name="tracking_number" class="form-control" required></td>
                        <?php endif; ?>
                        <td>
                            <button type="submit" class="btn btn-success">Verify</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    <?php endif; ?>
    <a href="view_order.php" class="btn btn-primary">Back to Order List</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>