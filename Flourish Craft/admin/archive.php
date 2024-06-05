<?php
include_once "../db.php";

$sql_archived_orders = "SELECT o.Order_ID, c.Name, o.Set_Name, o.Variation, o.Quantity, o.Price, o.Delivery_Date, o.mode_of_payment, o.mode_of_delivery, o.Order_Date
                        FROM `order` o
                        INNER JOIN customers c ON o.Customer_ID = c.Customer_ID
                        WHERE o.archived = TRUE";
$archived_orders_result = $conn->query($sql_archived_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Archived Orders</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Set Name</th>
                <th>Variation</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delivery Date</th>
                <th>Mode of Payment</th>
                <th>Mode of Delivery</th>
                <th>Ordered Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($archived_orders_result->num_rows > 0): ?>
                <?php while($row = $archived_orders_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["Name"]) ?></td>
                        <td><?= htmlspecialchars($row["Set_Name"]) ?></td>
                        <td><?= htmlspecialchars($row["Variation"]) ?></td>
                        <td><?= htmlspecialchars($row["Quantity"]) ?></td>
                        <td><?= htmlspecialchars($row["Price"]) ?></td>
                        <td><?= htmlspecialchars($row["Delivery_Date"]) ?></td>
                        <td><?= htmlspecialchars($row["mode_of_payment"]) ?></td>
                        <td><?= htmlspecialchars($row["mode_of_delivery"]) ?></td>
                        <td><?= htmlspecialchars($row["Order_Date"]) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan='9'>No archived orders found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
