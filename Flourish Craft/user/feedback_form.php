<?php
session_start();

if (!isset($_SESSION['customers_username'])) {
    header("Location: login.php");
    exit;
}

include_once "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['feedback'])) {
    $order_id = $_POST['order_id'];
    $feedback = $_POST['feedback'];

    $stmt_order_set_name = $conn->prepare("SELECT Set_Name FROM `order` WHERE Order_ID = ?");
    $stmt_order_set_name->bind_param("i", $order_id);
    $stmt_order_set_name->execute();
    $stmt_order_set_name->bind_result($set_name);
    $stmt_order_set_name->fetch();
    $stmt_order_set_name->close();

    $stmt_feedback = $conn->prepare("INSERT INTO review (Customer_Review, Customer_ID, Set_Name) VALUES (?, (SELECT Customer_ID FROM customers WHERE Username = ?), ?)");
    $stmt_feedback->bind_param("sss", $feedback, $_SESSION['customers_username'], $set_name);
    $stmt_feedback->execute();
    $stmt_feedback->close();

    header("Location: user_index.php");
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt_order = $conn->prepare("SELECT o.Order_ID, o.Set_Name, o.Variation, o.Quantity, o.Price, o.Delivery_Date, o.mode_of_payment, o.mode_of_delivery, s.Tracking_Number
                            FROM `order` o 
                            LEFT JOIN shipping s ON o.Order_ID = s.Order_ID 
                            INNER JOIN customers c ON o.Customer_ID = c.Customer_ID 
                            WHERE c.Username = ? AND o.Order_ID = ?");
    $stmt_order->bind_param("si", $_SESSION['customers_username'], $order_id);
    $stmt_order->execute();
    $orders = $stmt_order->get_result();
    $stmt_order->close();
} else {
    header("Location: user_profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Feedback Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/feedback_form.css">
</head>
<body>

<section class="container mt-5">
<div class="card pink-background">
    <div class="card-header bg-card pink-background text-white">
        <h2 class="text-center">Feedback Form</h2>
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <?php while ($order = $orders->fetch_assoc()): ?>
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
          <form action="feedback_form.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo $order['Order_ID']; ?>">
            <div class="form-group mt-2">
              <label for="feedback">Feedback:</label>
              <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2">Submit Feedback</button>
          </form>
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