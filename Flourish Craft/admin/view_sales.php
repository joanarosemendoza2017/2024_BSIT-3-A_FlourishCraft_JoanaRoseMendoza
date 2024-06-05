<?php

include_once "../db.php"; 

if (isset($conn) && $conn) {

    $today = date('Y-m-d');
    $result = $conn->query("SELECT SUM(Price) as total FROM `order` WHERE DATE(Order_Date) = '$today'");
    $today_sales = $result->fetch_assoc()['total'];

    $start_of_week = date('Y-m-d', strtotime('monday this week'));
    $result = $conn->query("SELECT SUM(Price) as total FROM `order` WHERE DATE(Order_Date) >= '$start_of_week'");
    $week_sales = $result->fetch_assoc()['total'];

    $start_of_month = date('Y-m-01');
    $result = $conn->query("SELECT SUM(Price) as total FROM `order` WHERE DATE(Order_Date) >= '$start_of_month'");
    $month_sales = $result->fetch_assoc()['total'];

    $start_of_year = date('Y-01-01');
    $result = $conn->query("SELECT SUM(Price) as total FROM `order` WHERE DATE(Order_Date) >= '$start_of_year'");
    $year_sales = $result->fetch_assoc()['total'];
} else {
    die("Connection failed: Unable to connect to the database.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/view_sales.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Sales Summary</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Period</th>
                    <th>Sales</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Today</td>
                    <td><?php echo '₱' . number_format($today_sales, 2); ?></td>
                </tr>
                <tr>
                    <td>This Week</td>
                    <td><?php echo '₱' . number_format($week_sales, 2); ?></td>
                </tr>
                <tr>
                    <td>This Month</td>
                    <td><?php echo '₱' . number_format($month_sales, 2); ?></td>
                </tr>
                <tr>
                    <td>This Year</td>
                    <td><?php echo '₱' . number_format($year_sales, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($conn)) {
    $conn->close();
}
?>