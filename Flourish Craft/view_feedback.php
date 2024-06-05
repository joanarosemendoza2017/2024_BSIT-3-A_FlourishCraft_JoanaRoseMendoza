<?php
include_once "db.php"; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT r.Customer_Review, r.Set_Name
        FROM review r
        JOIN `set` s ON r.Set_Name = s.Set_Name";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/view_feedback.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Customer Reviews</h2>
    <div class="table-responsive">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='review-box'>";
                echo "<div class='review-title'>Review:</div>";
                echo "<div class='review-text'>" . $row["Customer_Review"]. "</div>";
                echo "<div class='set-name'>Set Name: " . $row["Set_Name"]. "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='text-center'>No reviews found</div>";
        }
        $conn->close();
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>