<?php
session_start();
include_once "../db.php";

$setName = "Set not found";
$setPrice = 0;
$quantity = 1;
$totalPrice = 0;
$deliveryDate = '';
$chosenColor = '';
$paymentMethod = '';
$deliveryMethod = '';
$shippingFee = 100; // Shipping fee value

$accountName = '';
$accountNumber = '';
$referenceNumber = '';
$amount = 0;

if (isset($_SESSION['customers_username'])) {
    $username = $_SESSION['customers_username'];
    $stmt = $conn->prepare("SELECT * FROM customers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($customer = $result->fetch_assoc()) {
        $customerName = $customer['Name'];
        $phoneNumber = $customer['Phone_Number'];
        $houseNumber = $customer['House_Number'];
        $zone = $customer['Zone'];
        $barangay = $customer['Barangay'];
        $city = $customer['City'];
        $province = $customer['Province'];
        $region = $customer['Region'];
        $email = $customer['Email'];
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['set_id'])) {
        $setId = $_POST['set_id'];
        $stmt = $conn->prepare("
            SELECT s.Set_Name, p.Price
            FROM `set` s
            JOIN `price` p ON s.Price_ID = p.Price_ID
            WHERE s.Set_ID = ?
        ");
        $stmt->bind_param("i", $setId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($set = $result->fetch_assoc()) {
            $setName = $set['Set_Name'];
            $setPrice = $set['Price'];
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
            $totalPrice = $setPrice * $quantity;
            $stmt->close();
        }
    }

    if (isset($_POST['delivery_date'])) {
        $deliveryDate = $_POST['delivery_date'];
    }

    if (isset($_POST['color'])) {
        $chosenColor = $_POST['color'];
    }

    if (isset($_POST['payment_method'])) {
        $paymentMethod = $_POST['payment_method'];
    }

    if (isset($_POST['delivery_method'])) {
        $deliveryMethod = $_POST['delivery_method'];
        // Add shipping fee if delivery method is delivery
        if ($deliveryMethod === 'delivery') {
            $totalPrice += $shippingFee;
        }
    }

    if (isset($_POST['account_name'])) {
        $accountName = $_POST['account_name'];
    }

    if (isset($_POST['account_number'])) {
        $accountNumber = $_POST['account_number'];
    }

    if (isset($_POST['reference_number'])) {
        $referenceNumber = $_POST['reference_number'];
    }

    if (isset($_POST['amount'])) {
        $amount = $_POST['amount'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order Summary</title>
  <link rel="stylesheet" href="../styles/process_order.css">
</head>
<body>
  <div class="container">
    <div class="box">
      <h2>Order Summary</h2>
      <div class="form-group">
        <p>Set Name: <?php echo htmlspecialchars($setName); ?></p>
        <p>Price per set: ₱<?php echo htmlspecialchars($setPrice); ?></p>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" class="readonly" value="<?php echo htmlspecialchars($quantity); ?>" min="1" readonly>
        
        <?php if($deliveryMethod === 'delivery'): ?>
            <p>Shipping Fee: ₱<?php echo htmlspecialchars($shippingFee); ?></p>
        <?php endif; ?>
        
        <p>Total Price: ₱<?php echo htmlspecialchars($totalPrice); ?></p>

        <label for="delivery_date">Delivery Date:</label>
        <input type="date" id="delivery_date" name="delivery_date" class="readonly" value="<?php echo htmlspecialchars($deliveryDate); ?>" readonly>

        <p>Chosen Color: <?php echo htmlspecialchars($chosenColor); ?></p>
        <p>Payment Method: <?php echo htmlspecialchars($paymentMethod); ?></p>
        <p>Delivery Method: <?php echo htmlspecialchars($deliveryMethod); ?></p>
        <p id="courier-info" class="<?php echo ($deliveryMethod === 'pickup') ? 'hidden' : ''; ?>">Courier: <?php echo "J&T Express"; ?></p>
      </div>
    </div>

    <div class="box">
      <h2>Delivery Details</h2>
      <div class="details">
        <p>Name: <?php echo htmlspecialchars($customerName); ?></p>
        <p>Phone Number: <?php echo htmlspecialchars($phoneNumber); ?></p>
        <p>House Number: <?php echo htmlspecialchars($houseNumber); ?></p>
        <p>Zone: <?php echo htmlspecialchars($zone); ?></p>
        <p>Barangay: <?php echo htmlspecialchars($barangay); ?></p>
        <p>City: <?php echo htmlspecialchars($city); ?></p>
        <p>Province: <?php echo htmlspecialchars($province); ?></p>
        <p>Region: <?php echo htmlspecialchars($region); ?></p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
      </div>
    </div>

    <div class="box">
      <h2>Payment Details</h2>
      <form id="order-form" action="place_order.php" method="post">
        <input type="hidden" name="set_id" value="<?php echo htmlspecialchars($setId); ?>">
        <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
        <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($totalPrice); ?>">
        <input type="hidden" name="delivery_date" value="<?php echo htmlspecialchars($deliveryDate); ?>">
        <input type="hidden" name="variation" value="<?php echo htmlspecialchars($chosenColor); ?>">
        <input type="hidden" name="payment_method" value="<?php echo htmlspecialchars($paymentMethod); ?>">
        <input type="hidden" name="delivery_method" value="<?php echo htmlspecialchars($deliveryMethod); ?>">
        
        <?php if($paymentMethod === 'gcash'): ?>
          <h2>Send Here: 09618589268 Rhea Mae Samaniego</h2>
        <label for="account_name">Account Name:</label>
        <input type="text" id="account_name" name="account_name" value="<?php echo htmlspecialchars($accountName); ?>">

        <label for="account_number">Account Number:</label>
        <input type="text" id="account_number" name="account_number" value="<?php echo htmlspecialchars($accountNumber); ?>">

        <label for="reference_number">Reference Number:</label>
        <input type="text" id="reference_number" name="reference_number" value="<?php echo htmlspecialchars($referenceNumber); ?>">

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" value="<?php echo htmlspecialchars($amount); ?>" step="0.01">

        <div id="error-message" style="color: red; display: none;">Enter exact amount.</div>
        <?php endif; ?>

        <div class="button-container">
          <button type="button" class="place-order-btn" onclick="<?php echo ($paymentMethod === 'gcash') ? 'validateAmount()' : 'document.getElementById(\'order-form\').submit()'; ?>">Place Order</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const deliveryMethod = "<?php echo $deliveryMethod; ?>";
        const courierInfo = document.getElementById('courier-info');
        if (deliveryMethod === 'pickup') {
            courierInfo.classList.add('hidden');
        }
    });

    function validateAmount() {
        const totalPrice = parseFloat(document.querySelector('input[name="total_price"]').value);
        const amount = parseFloat(document.getElementById('amount').value);
        const errorMessage = document.getElementById('error-message');

        if (amount !== totalPrice) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            document.getElementById('order-form').submit();
        }
    }
  </script>
</body>
</html>
