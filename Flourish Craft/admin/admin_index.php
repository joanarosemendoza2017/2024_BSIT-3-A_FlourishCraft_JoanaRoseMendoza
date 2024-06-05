<?php
session_start();

include_once "../db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_profile"])) {

    if(isset($_SESSION["Customer_ID"])) {
        $loggedInCustomerId = $_SESSION["Customer_ID"];

        $newUsername = isset($_POST["Username"]) ? $_POST["Username"] : "";
        $newPassword = isset($_POST["Password"]) ? $_POST["Password"] : "";

        $sql = "UPDATE customers SET Username='$newUsername', Password='$newPassword' WHERE Customer_ID='$loggedInCustomerId'";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Profile updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating profile: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: Customer_ID not set in session.</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Profile</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/admin_profile.css">

  <style>
  /* Custom styles for the search form */
/* Custom styles for the search form */
.search-form {
    margin-top: 20px; /* Adjust the top margin as needed */
    width: 40%; /* Adjust the width of the form */
    margin: 0 auto; /* Align the form to the center */
    margin-bottom: 50px;
}

.search-input {
    border-top-right-radius: 0; /* Round only the left corners of the input field */
    border-bottom-right-radius: 0;
}

.btn-custom {
    background-color: #D24545; /* Custom background color */
    color: white; /* Text color */
    border: none; /* Remove border */
    border-top-left-radius: 0; /* Round only the right corners of the button */
    border-bottom-left-radius: 0;
}

.btn-custom:hover {
    background-color: #FF5580; /* Darker color on hover */
}


    </style>
</head>
<body>


    <div class="container">
    <!-- Add the search bar here -->
    <form action="search.php" method="get" class="search-form">
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search for orders, items, or buyer names" name="search_query">
            <div class="input-group-append">
                <button class="btn btn-custom" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>


    <!-- Your existing code for the navigation menu -->
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Flourish Craft</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Dashboard</li>
              <li class="list-group-item"><a href="view_order.php">View Orders</a></li>
              <li class="list-group-item"><a href="view_sales.php">View Sales</a></li>
              <li class="list-group-item"><a href="stocks_admin.php">View Stocks</a></li>
              <li class="list-group-item"><a href="admin_profile.php">View Products</a></li>
              <li class="list-group-item"><a href="add_product.php">Add Product</a></li>
              <li class="list-group-item"><a href="archive.php">Archived Orders</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Your existing code for the scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>