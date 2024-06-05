<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/registration.css">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <?php if(isset($_SESSION['registration_success']) && $_SESSION['registration_success']): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Registration Successful!</h5>
                            <p class="card-text">You have successfully registered. Please <a href="login.php" class="card-link">login here</a>.</p>
                        </div>
                    </div>
                    <?php unset($_SESSION['registration_success']); ?>
                <?php else: ?>
                    <div class="registration-form">
                        <h3 class="display-4 text-center mb-4">Registration Form</h3>
                        <?php if(isset($_GET['error'])): ?>
                            <div class="alert alert-danger"><?php echo "Error: " . $_GET['error']; ?></div>
                        <?php endif; ?>
                        <form action="process_registration.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="r_name">Name</label>
                                    <input id="r_name" name="r_name" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="r_age">Age</label>
                                    <input id="r_age" name="r_age" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="r_gender">Gender</label>
                                    <select id="r_gender" name="r_gender" class="form-control" required>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="X">Rather Not Say</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="r_phone">Phone Number</label>
                                    <input id="r_phone" name="r_phone" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="r_house_number">House Number</label>
                                    <input id="r_house_number" name="r_house_number" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="r_zone">Zone</label>
                                    <input id="r_zone" name="r_zone" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="r_barangay">Barangay</label>
                                    <input id="r_barangay" name="r_barangay" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="r_city">City</label>
                                    <input id="r_city" name="r_city" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="r_province">Province</label>
                                    <input id="r_province" name="r_province" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="r_region">Region</label>
                                    <input id="r_region" name="r_region" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="r_zip_code">Zip Code</label>
                                    <input id="r_zip_code" name="r_zip_code" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="r_email">Email</label>
                                    <input id="r_email" name="r_email" type="email" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="r_username">Username</label>
                                    <input id="r_username" name="r_username" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="r_password">Password</label>
                                    <input id="r_password" name="r_password" type="password" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="r_confirm_password">Confirm Password</label>
                                    <input id="r_confirm_password" name="r_confirm_password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success btn-lg" value="Register">
                                <a href="index.php" class="btn btn-link">Login</a>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>