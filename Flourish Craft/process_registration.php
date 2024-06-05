<?php
include_once "db.php";

$name =  $_POST['r_name'];
$age = $_POST['r_age'];
$gender = $_POST['r_gender'];
$phone = $_POST['r_phone'];
$house = $_POST['r_house_number'];
$zone =  $_POST['r_zone'];
$barangay =  $_POST['r_barangay'];
$city =  $_POST['r_city'];
$province =  $_POST['r_province'];
$region =  $_POST['r_region'];
$zip =  $_POST['r_zip_code'];
$email =  $_POST['r_email'];
$username =  $_POST['r_username'];
$password = $_POST['r_password'];
$confirm_password = $_POST['r_confirm_password'];

function chk_pass($p1, $p2) {
    return ($p1 == $p2) ? true : false;
}

if (!chk_pass($password, $confirm_password)) {
    header("location: registration.php?error=password_mismatch");
    exit;
}

$stmt = $conn->prepare("SELECT Customer_id FROM customers WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$count_result = $stmt->num_rows;
$stmt->close();

if ($count_result > 0) {
    header("location: registration.php?error=user_already_exist");
    exit;
} else {
    $stmt = $conn->prepare("INSERT INTO customers (Name, Age, Gender, Phone_Number, House_Number, Zone, Barangay, City, Province, Region, Zip_Code, Email, Username, Password)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssss", $name, $age, $gender, $phone, $house, $zone, $barangay, $city, $province, $region, $zip, $email, $username, $password);
    $execute_query = $stmt->execute();

    if (!$execute_query) {
        header("location: registration.php?error=insert_failed");
        exit;
    } else {
        session_start();
        $_SESSION['registration_success'] = true;
        header("location: registration.php");
        exit;
    }
}
?>