<?php
include_once "../db.php";
$sets = [];

if (isset($_GET['set_id'])) {
    $setId = $_GET['set_id'];

    $stmt = $conn->prepare("
        SELECT s.Set_Name, s.set_img, s.Description, p.Price
        FROM `set` s
        JOIN `price` p ON s.Price_ID = p.Price_ID
        WHERE s.Set_ID = ?
    ");
    $stmt->bind_param("i", $setId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($set = $result->fetch_assoc()) {
        $setName = $set['Set_Name'];
        $setImage = $set['set_img'];
        $setDescription = $set['Description'];
        $setPrice = $set['Price'];

        $sets[] = [
            'setName' => $setName,
            'imageUrl' => $setImage,
            'setDescription' => $setDescription,
            'setPrice' => $setPrice
        ];
    }

    if (empty($sets)) {
        $setName = "Unknown Set";
        $setImage = "default.jpg";
        $setDescription = "Description not available";
        $setPrice = 0;
        $sets[] = [
            'setName' => $setName,
            'imageUrl' => $setImage,
            'setDescription' => $setDescription,
            'setPrice' => $setPrice
        ];
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flowers shop - Product page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/reset.css">
  <link rel="stylesheet" href="../styles/user_product.css">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond&display=swap" rel="stylesheet"> 
</head>
<body>
  
  <header>
    <nav class="nav-bar">
      <img src="../images/rose-logo.png" alt="logo">
      <span><a class="title" href="index.php">Flourish Craft</a></span>
      <ul class="menu">
        <li><a href="index.php#crafts-gallery">Crafts Gallery</a> </li>
        <li><a href="catalogue.php">Flowers Catalogue</a> </li>
        <li><a href="">Contact</a> </li>
      </ul>
      <div class="icons">
        <div class="icon-btn menu-btn">
          <a href="">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </a>
        </div>
        <div class="icon-btn like-btn">
          <a href="">
            <i class="fa fa-heart" aria-hidden="true"></i>
          </a>
        </div>
        <div class="icon-btn cart-btn">
          <a href="">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </nav>
  </header>

  <main class="main-container">
    <?php foreach ($sets as $set): ?>
    <div class="selected-product">
      <div class="product-img">
        <div class="upper-elements">
          <div class="pagination">
            <div class="ball ball1"></div>
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
          </div>
          <div class="discount">
            
          </div>
        </div>
        <div class="lower-elements">
          <div class="arrows">
            <i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </div>
          <span></span>
        </div>
        <div class="main-img-frame">
          <img src="../images/<?php echo htmlspecialchars($set['imageUrl']); ?>" alt="<?php echo htmlspecialchars($set['setName']); ?>">
        </div>
      </div>
      <div class="product-info">
        <div class="product-title line">
          <h1><?php echo htmlspecialchars($set['setName']); ?></h1>
          <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
        </div>
        <div class="size line">Description: <?php echo htmlspecialchars($set['setDescription']); ?></div>
        <div class="total line">
          <span class="new-price">₱<?php echo htmlspecialchars($set['setPrice']); ?></span>
          
          <form id="orderForm" action="process_order.php" method="post">
            <input type="hidden" name="set_id" value="<?php echo htmlspecialchars($setId); ?>">
            <div class="quantity-input">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
            </div>
            <div class="delivery-date-input">
                <label for="delivery_date">Delivery Date:</label>
                <input type="date" id="delivery_date" name="delivery_date">
            </div>
            <div class="color-selection">
                <label>Choose Color:</label>
                <div>
                    <input type="radio" id="color_red" name="color" value="red">
                    <label for="color_red">Red</label>
                </div>
                <div>
                    <input type="radio" id="color_violet" name="color" value="violet">
                    <label for="color_violet">Violet</label>
                </div>
                <div>
                    <input type="radio" id="color_yellow" name="color" value="yellow">
                    <label for="color_yellow">Yellow</label>
                </div>
                <div>
                    <input type="radio" id="color_blue" name="color" value="blue">
                    <label for="color_blue">Blue</label>
                </div>
                <div>
                    <input type="radio" id="color_pink" name="color" value="pink">
                    <label for="color_pink">Pink</label>
                </div>
                <div>
                    <input type="radio" id="color_brown" name="color" value="brown">
                    <label for="color_brown">Brown</label>
                </div>
            </div>
            <div class="payment-method">
                <label>Choose Payment Method:</label>
                <div>
                    <input type="radio" id="payment_cod" name="payment_method" value="cod">
                    <label for="payment_cod">Cash on Delivery (COD)</label>
                </div>
                <div>
                    <input type="radio" id="payment_gcash" name="payment_method" value="gcash">
                    <label for="payment_gcash">GCash</label>
                </div>
            </div>
            <div class="delivery-method">
                <label>Choose Delivery Method:</label>
                <div>
                    <input type="radio" id="delivery_pickup" name="delivery_method" value="pickup">
                    <label for="delivery_pickup">Pickup</label>
                </div>
                <div>
                    <input type="radio" id="delivery_delivery" name="delivery_method" value="delivery">
                    <label for="delivery_delivery">Delivery</label>
                </div>
            </div>
            <button type="submit" class="buy-btn">Buy</button>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </main>
  
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const deliveryDateInput = document.getElementById('delivery_date');
        if (deliveryDateInput) {
            const today = new Date().toISOString().split('T')[0];
            deliveryDateInput.value = today;
            deliveryDateInput.setAttribute('min', today);
        }
        
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            const colorSelected = document.querySelector('input[name="color"]:checked');
            const paymentMethodSelected = document.querySelector('input[name="payment_method"]:checked');
            const deliveryMethodSelected = document.querySelector('input[name="delivery_method"]:checked');
            
            if (!colorSelected || !paymentMethodSelected || !deliveryMethodSelected) {
                event.preventDefault();
                alert('Please select a color, payment method, and delivery method.');
            }
        });
    });
  </script>
</body>
</html>