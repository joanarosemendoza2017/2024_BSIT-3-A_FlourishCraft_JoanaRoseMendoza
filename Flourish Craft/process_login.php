<?php
include_once "db.php";
session_start();

if(isset($_POST['f_username']) && isset($_POST['f_password'])){
    $uname = $_POST['f_username'];
    $pword = $_POST['f_password'];

    $stmt = $conn->prepare("SELECT * FROM customers WHERE Username = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();

        if ($pword == $row['Password']) {

            $_SESSION['customers_id'] = $row['Customer_ID'];
            $_SESSION['customers_name'] = $row['Name'];
            $_SESSION['customers_username'] = $row['Username'];
            $_SESSION['customers_user_type'] = $row['user_type'];

            if($row['user_type'] == 'A'){
                header("Location: admin/admin_index.php");
                exit;
            } elseif($row['user_type'] == 'C'){
                header("Location: user/user_index.php");
                exit;
            } else {
                header("Location: error_page.php");
                exit;
            }
        } else {
            header("Location: login.php?error=wrongpass");
            exit;
        }
    } else {
        header("Location: login.php?error=nouser");
        exit;
    }
} else {
    header("Location: login.php?error=invalidrequest");
    exit;
}
?>