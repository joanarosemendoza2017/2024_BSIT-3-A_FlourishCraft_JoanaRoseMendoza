<?php
include_once "../db.php";

$sql = "SELECT o.Order_ID, c.Name, o.Set_Name, o.Variation, o.Quantity, o.Price, o.Delivery_Date, o.mode_of_payment, o.mode_of_delivery, o.Order_Date
        FROM `order` o
        INNER JOIN customers c ON o.Customer_ID = c.Customer_ID
        LEFT JOIN shipping s ON o.Order_ID = s.Order_ID
        WHERE s.Order_ID IS NULL AND o.archived = FALSE";
$order_result = $conn->query($sql);

$sql_shipping = "SELECT s.Order_ID, s.Tracking_Number, o.Set_Name, c.Name 
                 FROM shipping s 
                 INNER JOIN `order` o ON s.Order_ID = o.Order_ID 
                 INNER JOIN customers c ON o.Customer_ID = c.Customer_ID
                 WHERE o.order_status != 'delivered' AND o.archived = FALSE";
$shipping_result = $conn->query($sql_shipping);

$sql_orders_done = "SELECT s.Order_ID, s.Tracking_Number, o.Set_Name, c.Name, o.Order_Date 
                    FROM shipping s 
                    INNER JOIN `order` o ON s.Order_ID = o.Order_ID 
                    INNER JOIN customers c ON o.Customer_ID = c.Customer_ID
                    WHERE o.order_status = 'delivered' AND o.archived = FALSE";
$orders_done_result = $conn->query($sql_orders_done);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Order List</h1>
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
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php if ($order_result->num_rows > 0): ?>
                <?php while($row = $order_result->fetch_assoc()): ?>
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
                        <td><button class='btn btn-primary verify-payment' data-order-id='<?= htmlspecialchars($row["Order_ID"]) ?>'>Verify Payment</button></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan='10'>No orders found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h1 class="my-4">Shipping Information</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Set Name</th>
                <th>Tracking Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($shipping_result->num_rows > 0): ?>
                <?php while($row = $shipping_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["Name"]) ?></td>
                        <td><?= htmlspecialchars($row["Set_Name"]) ?></td>
                        <td><?= htmlspecialchars($row["Tracking_Number"]) ?></td>
                        <td><button class='btn btn-success ship-order' data-order-id='<?= htmlspecialchars($row["Order_ID"]) ?>'>Ship</button></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan='4'>No shipping information found</td></tr>
            <?php endif; ?>
            <?php $conn->close(); ?>
        </tbody>
    </table>

    <h1 class="my-4">Orders Done</h1>
    <table class="table table-striped" id="orders-done-table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Set Name</th>
                <th>Tracking Number</th>
                <th>Date Ordered</th>
                <th>Action</th>
                <th>Archive</th> <!-- New column for Archive button -->
            </tr>
        </thead>
        <tbody>
            <?php if ($orders_done_result->num_rows > 0): ?>
                <?php while($row = $orders_done_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["Name"]) ?></td>
                        <td><?= htmlspecialchars($row["Set_Name"]) ?></td>
                        <td><?= htmlspecialchars($row["Tracking_Number"]) ?></td>
                        <td><?= htmlspecialchars($row["Order_Date"]) ?></td>
                        <td><button class="btn btn-secondary" disabled>Delivered</button></td>
                        <!-- New column for Archive button -->
                        <td><button class="btn btn-danger archive-order" data-order-id="<?= htmlspecialchars($row["Order_ID"]) ?>">Archive</button></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan='6'>No orders done found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.verify-payment').forEach(item => {
        item.addEventListener('click', event => {
            const orderId = item.getAttribute('data-order-id');
            window.location.href = 'verify_payment.php?order_id=' + encodeURIComponent(orderId);
        });
    });

    document.querySelectorAll('.ship-order').forEach(item => {
        item.addEventListener('click', event => {
            const orderId = item.getAttribute('data-order-id');
            fetch('update_order_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ order_id: orderId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const row = item.closest('tr');
                    row.remove();
                    const ordersDoneTable = document.getElementById('orders-done-table');
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${data.order_details.Name}</td>
                        <td>${data.order_details.Set_Name}</td>
                        <td>${data.order_details.Tracking_Number}</td>
                        <td>${data.order_details.Order_Date}</td>
                        <td><button class="btn btn-secondary" disabled>Delivered</button></td>
                        <td><button class="btn btn-danger archive-order" data-order-id="${data.order_details.Order_ID}">Archive</button></td>
                    `;
                    ordersDoneTable.querySelector('tbody').appendChild(newRow);
                } else {
                    console.error('Failed to update order status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    document.querySelectorAll('.archive-order').forEach(item => {
        item.addEventListener('click', event => {
            const orderId = item.getAttribute('data-order-id');
            fetch('archive_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ order_id: orderId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const row = item.closest('tr');
                    row.remove();
                } else {
                    console.error('Failed to archive order');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
</body>
</html>
