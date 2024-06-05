<?php
session_start();
if (!isset($_SESSION['customers_username'])) {
    header("Location: login.php");
    exit;
}

include('../db.php');

$username = $_SESSION['customers_username'];
$query = "SELECT * FROM customers WHERE username=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
$user = mysqli_fetch_assoc($result);
if (!$user) {
    die("Error: User data not found.");
}

$name = $user['Name'] ?? '';
$age = $user['Age'] ?? '';
$gender = $user['Gender'] ?? '';
$phone = $user['Phone_Number'] ?? '';
$house_number = $user['House_Number'] ?? '';
$zone = $user['Zone'] ?? '';
$barangay = $user['Barangay'] ?? '';
$city = $user['City'] ?? '';
$province = $user['Province'] ?? '';
$region = $user['Region'] ?? '';
$zip_code = $user['Zip_Code'] ?? '';
$email = $user['Email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['Name'] ?? '');
    $age = mysqli_real_escape_string($conn, $_POST['Age'] ?? '');
    $gender = mysqli_real_escape_string($conn, $_POST['Gender'] ?? '');
    $phone = mysqli_real_escape_string($conn, $_POST['Phone'] ?? '');
    $house_number = mysqli_real_escape_string($conn, $_POST['House_Number'] ?? '');
    $zone = mysqli_real_escape_string($conn, $_POST['Zone'] ?? '');
    $barangay = mysqli_real_escape_string($conn, $_POST['Barangay'] ?? '');
    $city = mysqli_real_escape_string($conn, $_POST['City'] ?? '');
    $province = mysqli_real_escape_string($conn, $_POST['Province'] ?? '');
    $region = mysqli_real_escape_string($conn, $_POST['Region'] ?? '');
    $zip_code = mysqli_real_escape_string($conn, $_POST['Zip_Code'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['Email'] ?? '');

    $update_query = "UPDATE customers SET 
        Name=?, 
        Age=?, 
        Gender=?, 
        Phone_Number=?, 
        House_Number=?, 
        Zone=?, 
        Barangay=?, 
        City=?, 
        Province=?, 
        Region=?, 
        Zip_Code=?, 
        Email=? 
        WHERE username=?";

    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $name, $age, $gender, $phone, $house_number, $zone, $barangay, $city, $province, $region, $zip_code, $email, $username);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['customers_name'] = $name;
        $_SESSION['login_message'] = "Your information has been updated successfully.";
        header("Location: user_profile.php");
        exit;
    } else {
        $error_message = "Error updating information: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/edit_user.css">

</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-pink text-white text-center">
                        <h2>Edit Information</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error_message)) { ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php } ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Age">Age</label>
                                    <input type="text" class="form-control" id="Age" name="Age" value="<?php echo htmlspecialchars($age); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Gender">Gender</label>
                                    <select class="form-control" id="Gender" name="Gender" required>
                                        <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Phone">Phone Number</label>
                                <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="House_Number">House Number</label>
                                <input type="text" class="form-control" id="House_Number" name="House_Number" value="<?php echo htmlspecialchars($house_number); ?>">
                            </div>
                            <div class="form-group">
                                <label for="Zone">Zone</label>
                                <input type="text" class="form-control" id="Zone" name="Zone" value="<?php echo htmlspecialchars($zone); ?>">
                            </div>
                            <div class="form-group">
                                <label for="Barangay">Barangay</label>
                                <input type="text" class="form-control" id="Barangay" name="Barangay" value="<?php echo htmlspecialchars($barangay); ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="City">City</label>
                                    <input type="text" class="form-control" id="City" name="City" value="<?php echo htmlspecialchars($city); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Province">Province</label>
                                    <input type="text" class="form-control" id="Province" name="Province" value="<?php echo htmlspecialchars($province); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Region">Region</label>
                                <input type="text" class="form-control" id="Region" name="Region" value="<?php echo htmlspecialchars($region); ?>">
                            </div>
                            <div class="form-group">
                                <label for="Zip_Code">Zip Code</label>
                                <input type="text" class="form-control" id="Zip_Code" name="Zip_Code" value="<?php echo htmlspecialchars($zip_code); ?>">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Update Information</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>