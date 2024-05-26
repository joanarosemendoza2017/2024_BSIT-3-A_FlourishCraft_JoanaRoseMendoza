<?php
session_start(); // Start session if not already started

include_once "db.php";

$error = ""; // Initialize error variable

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $error = "Please enter both username and password";
    } else {
        // Retrieve the user's password from the database
        $stmt = $conn->prepare("SELECT Password FROM customers WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($stored_password); // Changed variable name to avoid conflict
        $stmt->fetch();
        $stmt->close();

        // Verify the password
        if ($password == $stored_password) {
            // Password is correct, proceed with login
            // Store username in session for further authentication
            $_SESSION['username'] = $username;
            $_SESSION['login_message'] = "You have successfully logged in."; // Add success message to session
            header("location: index.php"); // Redirect to index.php
            exit;
        } else {
            // Password is incorrect
            $error = "Invalid username or password";
        }
    }
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./styles/login.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- MDB CSS for additional styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
  <style>
    .full-vh {
      height: 100vh;
      background-color: #f1add9;
    }
  </style>
</head>
<body>
  <section class="full-vh">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="images/SetA.png" alt="login form" class="img-fluid rounded-start" style="object-fit: cover; height: 100%;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="post" action="process_login.php">

              <div class="d-flex align-items-center mb-3 pb-1">
                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                <span class="h1 fw-bold mb-0" style="font-size: 50px;">Flourish Craft</span>
              </div>


                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                    <?php if(!empty($error)) { ?>
                      <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" name="f_username" id="username" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Username</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="f_password" id="form2Example27" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit" name="login">Login</button>
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="registration.php" style="color: #393f81;">Register here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- MDB JS -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>
</html>

