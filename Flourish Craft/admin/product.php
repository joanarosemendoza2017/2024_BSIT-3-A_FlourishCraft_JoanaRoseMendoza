<?php
include_once "../db.php"; 

$setId = isset($_GET['set_id']) ? $_GET['set_id'] : '';

$stmt = $conn->prepare("SELECT Set_Name, `Description`, Variation, Cost, set_img FROM `set` WHERE Set_ID = ?");
$stmt->bind_param("i", $setId);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $setName = $product['Set_Name'];
    $description = $product['Description'];
    $variation = $product['Variation'];
    $cost = $product['Cost'];
    $imageUrl = $product['set_img'];
} else {
    echo "Product not found.";
    exit();
}
$stmt->close();
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
  <link rel="stylesheet" href="../styles/admin_product.css">
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
      
      </div>
    </nav>
  </header>

  <main class="main-container">
    <div class="selected-product">
      <div class="product-img">
        <img src="../images/<?php echo $imageUrl; ?>" alt="<?php echo $setName; ?>">
      </div>
      <div class="product-info">
        <div class="product-title line">
          <h1><?php echo $setName; ?></h1>
          <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
        </div>
        <div class="size line">Description: <?php echo $description; ?></div>
        <div class="other-options line">
          <div class="variation">Variation: <?php echo $variation; ?></div><br> <br>
          <div class="cost">Cost: ₱ <?php echo $cost; ?></div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>