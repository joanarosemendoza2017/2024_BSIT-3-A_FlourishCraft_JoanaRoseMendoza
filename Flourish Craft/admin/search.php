<?php
session_start();
include_once "../db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Prepare and execute the SQL query to search for orders, items, or buyer names
$sql = "SELECT o.Order_ID, o.Set_Name, c.Name AS Customer_Name, o.Order_Date 
        FROM `order` o
        JOIN customers c ON o.Customer_ID = c.Customer_ID
        WHERE o.Order_ID LIKE '%$search_query%' 
        OR o.Set_Name LIKE '%$search_query%' 
        OR c.Name LIKE '%$search_query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <h1 class="mb-4">Search Results</h1>
    <?php if ($result->num_rows > 0) { ?>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Item</th>
          <th>Buyer</th>
          <th>Order Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row["Order_ID"]; ?></td>
          <td><?php echo $row["Set_Name"]; ?></td>
          <td><?php echo $row["Customer_Name"]; ?></td>
          <td><?php echo $row["Order_Date"]; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } else { ?>
    <div class="alert alert-info">No results found.</div>
    <?php } ?>
    <a href="admin_index.php" class="btn btn-secondary mt-3">Back to Admin Dashboard</a>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
