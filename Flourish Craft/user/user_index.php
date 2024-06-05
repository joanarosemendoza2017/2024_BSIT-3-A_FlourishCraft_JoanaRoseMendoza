<?php
session_start();

if (!isset($_SESSION['customers_username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flourish Craft</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/reset.css">
  <link rel="stylesheet" href="../styles/user_main.css">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
.search-form {
  display: flex;
  align-items: center;
  justify-content: center; /* Center horizontally */
}

.search-form input[type="text"] {
  width: 300px;
  padding: 10px;
  border: 3px solid #FF5580;
  border-radius: 20px;
  font-size: 16px;
  outline: none;
}

.search-form button[type="submit"] {
  background-color: #FF5580;
  color: #fff;
  border: none;
  border-radius: 20px;
  padding: 10px 20px;
  margin-left: 10px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.search-form button[type="submit"]:hover {
  background-color: #D24545;
}

  </style>
<body>

  <main class="main-container">
    <div class="page1">
      <div class="frame">
        <header>
          <nav class="nav-bar">
            <img class="rose-logo" src="../images/rose-logo.png" alt="logo">
            <h1 class="brand-header">
            <a href="user_index.php">Flourish Craft</a>
            </h1>
            <ul class="menu">
              <li><a href="user_index.php#crafts-gallery">Crafts Gallery</a></li>
              <li><a href="../catalogue.php">Flowers Catalogue</a></li>
              <li><a href="../login.php">Logout</a></li>
              <li>
                <div class="welcome-message">
                  <?php
                    if ($_SESSION['customers_user_type'] == 'C') {
                      echo "<h2><a href='user_profile.php'>" . htmlspecialchars($_SESSION['customers_name']) . "</a></h2>";
                    } else {
                        echo "<h2><a href='user_profile.php'>" . htmlspecialchars($_SESSION['customers_name']) . "</a></h2>";
                    }
                  ?>
                </div>
              </li>
            </ul>
          </nav>
        </header>
        <div class="main-img-container position-absolute">
          <img class="main-img" src="../images/sample1.png" alt="">
        </div>
        <div class="main-text">
          <h2 class="caption">Flourish Craft</h1>
          <h3 class="sub-caption">"Crafting Tomorrow's Treasures, Today"</h3>
          <div class="order-btn">
            <a href="../view_feedback.php">FEEDBACK</a>
          </div>
        </div>
      </div>
    </div>

    <aside id="crafts-gallery" class="crafts-section">
      <nav class="gallery-nav-bar">
        <h3 class="title">Crafts Gallery</h3>
        <div class="gallery-arrows">
          <a href="">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
          </a>
          &nbsp;
          <a href="">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </a>
        </div>
      </nav>
      <div class="slideshow">
        <div class="slide1">
          <img src="../images/rose4.png" alt="gallery-slide">
        </div>
        <div class="slide2">
          <img src="../images/rose5.png" alt="gallery-slide">
        </div>
        <div class="slide3">
          <img src="../images/rose6.png" alt="gallery-slide">
        </div>
      </div>
      <div class="pagination">
        <div class="ball1 ball"></div>
        <div class="ball2 ball"></div>
        <div class="ball3 ball"></div>
        <div class="ball4 ball"></div>
        <div class="ball5 ball"></div>
      </div>
    </aside>

    <section class="product-samples-section">
      <div class="product-samples-header">
        <h3 class="title">Product samples</h3>
      </div>
      
      <form action="search.php" method="GET" class="search-form">
    <input type="text" name="keywords" placeholder="Search here...">
    <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
</form>


      <div class="samples-box">
        <?php
        include_once "../db.php";

        // Fetch and display all sets
        $stmt = $conn->prepare("SELECT s.Set_ID, s.Set_Name, s.set_img, p.Price 
                                FROM `set` s 
                                INNER JOIN `price` p ON s.Price_ID = p.Price_ID 
                                ORDER BY s.Set_ID ASC");
        if ($stmt) {
          $stmt->execute();
          $result = $stmt->get_result();
          while ($product = $result->fetch_assoc()) {
            $setId = $product['Set_ID'];
            $setName = $product['Set_Name'];
            $setImage = $product['set_img'];
            $price = $product['Price'];
        ?>
            <div class="product product-<?php echo str_replace(" ", "-", strtolower($setName)); ?>">
              <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
              <div class="img-frame">
                <a href="product.php?set_id=<?php echo urlencode($setId); ?>">
                  <img src="../images/<?php echo $setImage; ?>" alt="<?php echo $setName; ?>">
                </a>
              </div>
              <span><?php echo htmlspecialchars($setName); ?></span>
              <span class="price-span">₱ <?php echo $price; ?></span>
            </div>
        <?php
          }
          $stmt->close();
        } else {
          echo "Error preparing statement: " . $conn->error;
        }
        ?>
      </div>
    </section>

    <footer>
      <img class="location" src="../images/location.png"   width="1270" height="1000" alt="Where we are">
      <nav class="footer-bar">
        <div class="subscribe-btn">
          <a href="https://www.google.com/maps/place/Samaniego+Residence/@13.2912394,123.5127284,17z/data=!4m6!3m5!1s0x33a1a1c4934b867f:0x894e7ddb77ca7db9!8m2!3d13.2914691!4d123.5135955!16s%2Fg%2F11t2q75mm_?entry=ttu" target="_blank">
            <span>Samaniego Residence</span>
            <i class="fa fa-location" aria-hidden="true"></i>
          </a>
        </div>
        <div class="address footer-block">
          <span>District 2</span>
          <span>09618589268</span>
          <span><form action="" method="get"></form>lourishCraft@gmail.com</span>
        </div>
        <div class="other-links footer-block">
          <a href="">Shipping return</a>
          <a href="">Info about us</a>
          <a href="">Discounts</a>        
        </div>
        <div class="copyright footer-block">
          <span>2024 Copyright information for this work</span>
          <div class="card-logos">
            <div class="card-logo card-logo3" style="margin-right: 10px;">
              <img src="../images/Gcash.png" alt="Gcash">
            </div>
          </div>
        </div>
      </nav>
    </footer>
  </main>
</body>
</html>
