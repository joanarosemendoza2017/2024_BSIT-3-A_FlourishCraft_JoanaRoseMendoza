<?php
session_start();

if (!isset($_SESSION['customers_username'])) {
    header("Location: login.php");
    exit;
}

include_once "../db.php";

$stmt_user = $conn->prepare("SELECT Name, Age, Gender, Phone_Number, House_Number, `Zone`, Barangay, City, Province, Region, Zip_Code, Email FROM customers WHERE Username = ?");
$stmt_user->bind_param("s", $_SESSION['customers_username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_received'])) {
    $order_id = $_POST['order_id'];

    $stmt_update_status = $conn->prepare("UPDATE `order` SET order_status = 'received' WHERE Order_ID = ?");
    $stmt_update_status->bind_param("i", $order_id);
    $stmt_update_status->execute();
    $stmt_update_status->close();

    $stmt_update_shipping_status = $conn->prepare("UPDATE `order` SET shipping_status = 'delivered' WHERE Order_ID = ?");
    $stmt_update_shipping_status->bind_param("i", $order_id);
    $stmt_update_shipping_status->execute();
    $stmt_update_shipping_status->close();

    header("Location: user_profile.php");
    exit;
}

$stmt_orders = $conn->prepare("SELECT o.Order_ID, o.Set_Name, o.Variation, o.Quantity, o.Price, o.Delivery_Date, o.mode_of_payment, o.mode_of_delivery, o.order_status, s.Tracking_Number
                            FROM `order` o 
                            LEFT JOIN shipping s ON o.Order_ID = s.Order_ID 
                            INNER JOIN customers c ON o.Customer_ID = c.Customer_ID 
                            WHERE c.Username = ?");
$stmt_orders->bind_param("s", $_SESSION['customers_username']);
$stmt_orders->execute();
$orders = $stmt_orders->get_result();
$stmt_orders->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/user_profile.css">

</head>
<body>
<section class="container mt-5">
    <div class="card pink-background">
    <div class="card-header bg-card pink-background text-white">
      <h2 class="text-center">User Profile</h2>
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Name:</strong> <?php echo htmlspecialchars($user['Name']); ?></li>
        <li class="list-group-item"><strong>Age:</strong> <?php echo htmlspecialchars($user['Age']); ?></li>
        <li class="list-group-item"><strong>Gender:</strong> <?php echo htmlspecialchars($user['Gender']); ?></li>
        <li class="list-group-item"><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['Phone_Number']); ?></li>
        <li class="list-group-item"><strong>House Number:</strong> <?php echo htmlspecialchars($user['House_Number']); ?></li>
        <li class="list-group-item"><strong>Zone:</strong> <?php echo htmlspecialchars($user['Zone']); ?></li>
        <li class="list-group-item"><strong>Barangay:</strong> <?php echo htmlspecialchars($user['Barangay']); ?></li>
        <li class="list-group-item"><strong>City:</strong> <?php echo htmlspecialchars($user['City']); ?></li>
        <li class="list-group-item"><strong>Province:</strong> <?php echo htmlspecialchars($user['Province']); ?></li>
        <li class="list-group-item"><strong>Region:</strong> <?php echo htmlspecialchars($user['Region']); ?></li>
        <li class="list-group-item"><strong>Zip Code:</strong> <?php echo htmlspecialchars($user['Zip_Code']); ?></li>
        <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></li>
      </ul>
    </div>
  </div>
</section>

  <div class="edit-profile-btn text-center">
    <a href="edit_user.php" class="btn btn-primary">Edit Profile</a>
  </div>

<section class="container mt-5">
<div class="card pink-background">
    <div class="card-header bg-card pink-background text-white">
      <h2 class="text-center">Your Orders</h2>
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <?php while ($order = $orders->fetch_assoc()): ?>
        <?php if ($order['order_status'] !== 'received'): ?>
        <li class="list-group-item">
          <strong>Set Name:</strong> <?php echo htmlspecialchars($order['Set_Name']); ?><br>
          <strong>Variation:</strong> <?php echo htmlspecialchars($order['Variation']); ?><br>
          <strong>Quantity:</strong> <?php echo htmlspecialchars($order['Quantity']); ?><br>
          <strong>Price:</strong> <?php echo htmlspecialchars($order['Price']); ?><br>
          <strong>Delivery Date:</strong> <?php echo htmlspecialchars($order['Delivery_Date']); ?><br>
          <strong>Payment Method:</strong> <?php echo htmlspecialchars($order['mode_of_payment']); ?><br>
          <strong>Delivery Method:</strong> <?php echo htmlspecialchars($order['mode_of_delivery']); ?><br>
          <?php if ($order['Tracking_Number']): ?>
            <strong>Tracking Number:</strong> <?php echo htmlspecialchars($order['Tracking_Number']); ?><br>
          <?php endif; ?>
          <strong>Order Status:</strong> <?php echo htmlspecialchars($order['order_status']); ?><br>
          <?php if ($order['order_status'] == 'delivered'): ?>
          <form action="user_profile.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo $order['Order_ID']; ?>">
            <button type="submit" name="order_received" class="btn btn-success mt-2">Order Received</button>
          </form>
          <?php endif; ?>
        </li>
        <?php endif; ?>
        <?php endwhile; ?>
      </ul>

    <section class="container mt-5">
<div class="card pink-background bg-pink text-white">
      <h2 class="text-center">Order History</h2>
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <?php 
        $stmt_received_orders = $conn->prepare("SELECT o.Order_ID, o.Set_Name, o.Variation, o.Quantity, o.Price, o.Delivery_Date, o.mode_of_payment, o.mode_of_delivery, s.Tracking_Number
                                              FROM `order` o 
                                              LEFT JOIN shipping s ON o.Order_ID = s.Order_ID 
                                              INNER JOIN customers c ON o.Customer_ID = c.Customer_ID 
                                              WHERE c.Username = ? AND o.order_status = 'received'");
        $stmt_received_orders->bind_param("s", $_SESSION['customers_username']);
        $stmt_received_orders->execute();
        $received_orders = $stmt_received_orders->get_result();
        $stmt_received_orders->close();
        
        while ($order = $received_orders->fetch_assoc()): ?>
        <li class="list-group-item">
          <strong>Set Name:</strong> <?php echo htmlspecialchars($order['Set_Name']); ?><br>
          <strong>Variation:</strong> <?php echo htmlspecialchars($order['Variation']); ?><br>
          <strong>Quantity:</strong> <?php echo htmlspecialchars($order['Quantity']); ?><br>
          <strong>Price:</strong> <?php echo htmlspecialchars($order['Price']); ?><br>
          <strong>Delivery Date:</strong> <?php echo htmlspecialchars($order['Delivery_Date']); ?><br>
          <strong>Payment Method:</strong> <?php echo htmlspecialchars($order['mode_of_payment']); ?><br>
          <strong>Delivery Method:</strong> <?php echo htmlspecialchars($order['mode_of_delivery']); ?><br>
          <?php if ($order['Tracking_Number']): ?>
            <strong>Tracking Number:</strong> <?php echo htmlspecialchars($order['Tracking_Number']); ?><br>
          <?php endif; ?>
          <a href="feedback_form.php?order_id=<?php echo $order['Order_ID']; ?>" class="btn btn-primary mt-2">Write Review</a>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</section>

</body>
</html>

<?php
$conn->close();
?>