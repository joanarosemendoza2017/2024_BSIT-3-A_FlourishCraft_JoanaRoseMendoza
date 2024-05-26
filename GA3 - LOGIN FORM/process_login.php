<?php
include_once "db.php";
session_start();

if(isset($_POST['f_username']) && isset($_POST['f_password'])){
    $uname = $_POST['f_username'];
    $pword = $_POST['f_password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM customers WHERE Username = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();

        // Compare plain text password
        if ($pword == $row['Password']) {
            // Password is correct, proceed with login

            // Store necessary user information in session
            $_SESSION['customers_id'] = $row['Customer_ID'];
            $_SESSION['customers_name'] = $row['Name'];
            $_SESSION['customers_username'] = $row['Username'];
            $_SESSION['customers_user_type'] = $row['user_type'];

            // Redirect based on user type
            if($row['user_type'] == 'A'){
                echo "admin";
                exit;
            } elseif($row['user_type'] == 'C'){
                echo "user";
                exit;
            } else {
                echo "not found";
                exit;
            }
        } else {
            // Incorrect password
            echo "wrong pass";
            exit;
        }
    } 
} else {
    // Invalid request
    echo "invalid";
    exit;
}
?>
