<?php
session_start();
include_once "../db.php";

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
    <link rel="stylesheet" href="../styles/admin_index.css">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main class="main-container">
        <div class="page1">
            <div class="frame">
                <header>
                    <nav class="nav-bar">
                        <img class="rose-logo" src="../images/rose-logo.png" alt="logo">
                        <h1 class="brand-header">
                            <a href="admin_index.php">Flourish Craft</a>
                        </h1>
                        <ul class="menu">
                        <li><a href="stocks_admin.php">Stocks</a></li>
                            <li><a href="add_product.php">Add Product</a></li>
                            <li><a href="../login.php">Logout</a></li>
                            <li>
                                <div class="welcome-message">
                                    <?php
                                    if ($_SESSION['customers_user_type'] == 'A') {
                                        echo '<a href="admin_index.php"><h2>' . htmlspecialchars($_SESSION['customers_name']) . '</h2></a>';
                                    } else {
                                        echo '<h2>' . htmlspecialchars($_SESSION['customers_name']) . '</h2>';
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
                    <h2 class="caption">Flourish Craft</h2>
                    <h3 class="sub-caption">"Crafting Tomorrow's Treasures, Today"</h3>
                    <div class="order-btn">
                        <a href="../view_feedback.php">FEEDBACKS</a>
                    </div>

                </div>
            </div>
        </div>

        <section class="product-samples-section">
            <div class="product-samples-header">
                <h3 class="title">Product samples</h3>
            </div>
            <div class="samples-box">
                <?php
                $stmt = $conn->prepare("SELECT s.Set_ID, s.Set_Name, s.Set_Img, s.Cost, s.Price_ID, p.Price 
                                        FROM `set` s INNER JOIN `price` p 
                                        ON s.Price_ID = p.Price_ID 
                                        ORDER BY s.Set_ID ASC");
                if ($stmt) {
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows === 0) {
                        echo "<p>No products found.</p>";
                    } else {
                        while ($product = $result->fetch_assoc()) {
                            $setId = $product['Set_ID'];
                            $setName = $product['Set_Name'];
                            $setImage = $product['Set_Img'];
                            $cost = $product['Cost'];
                            $price_id = $product['Price_ID'];
                            $price = $product['Price'];
                            ?>
                            <div class="product product-<?php echo str_replace(" ", "-", strtolower($setName)); ?>">
                                <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                <div class="img-frame">
                                    <a href="product.php?set_id=<?php echo urlencode($setId); ?>">
                                        <img src="../images/<?php echo $setImage; ?>" alt="<?php echo htmlspecialchars($setName); ?>">
                                    </a>
                                </div>
                                <span><?php echo htmlspecialchars($setName); ?></span>
                                <a href="edit_product.php?set_id=<?php echo urlencode($setId); ?>&set_name=<?php echo urlencode($setName); ?>" class="edit-btn">Edit</a>
                                <form method="post" action="delete_product.php">
                                    <input type="hidden" name="set_id" value="<?php echo $setId; ?>">
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                                <span class="price-span">₱ <?php echo $price; ?> <a href="login.php"></a></span>
                            </div>
                            <?php
                        }
                    }
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
                ?>
            </div>
        </section>
    </main>

    <?php
    if(isset($_SESSION['login_message'])) {
        echo '<script>';
        echo 'alert("' . $_SESSION['login_message'] . '");';
        echo '</script>';
        unset($_SESSION['login_message']);
    }
    if(isset($_SESSION['delete_message'])) {
        echo '<script>';
        echo 'alert("' . $_SESSION['delete_message'] . '");';
        echo '</script>';
        unset($_SESSION['delete_message']);
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>