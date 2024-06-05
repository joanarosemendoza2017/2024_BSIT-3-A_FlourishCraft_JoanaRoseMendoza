<?php
session_start();

include_once "db.php";

$error = "";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $error = "Please enter both username and password";
    } else {
        
        $stmt = $conn->prepare("SELECT Password FROM customers WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($stored_password); 
        $stmt->fetch();
        $stmt->close();

        if ($password == $stored_password) {
            $_SESSION['username'] = $username;
            $_SESSION['login_message'] = "You have successfully logged in."; 
            header("location: index.php");
            exit;
        } else {
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
  <style>
  body {
      background-image: url('userbg.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

.custom-button {
      background-color: #E74646; 
      border-radius: 40px;
    }
.card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
.img-fluid {
      border-radius: 1rem 0 0 1rem;
    }
.form-outline .form-label {
      color: #555;
    }
.form-outline .form-control {
      border-radius: 0.5rem;
      padding: 1rem;
      font-size: 1rem;
    }
.btn-custom {
      background-color: #b55843;
      color: #fff;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      border: none;
      border-radius: 0.5rem;
      transition: background-color 0.3s;
}
.btn-custom:hover {
      background-color: #FFEED94;
}
.custom-title {
      color: #ff6219; 
      font-size: 50px; 
}
.form-container {
      background-color: rgba(255, 255, 255, 0.8); 
      padding: 2rem;
      border-radius: 1rem;
}
.btn.custom-button:hover {
      background-color: #FFA27F !important;
      border-color: #FFA27F !important;
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
                <img src="images/one.png" alt="login form" class="img-fluid rounded-start" style="object-fit: cover; height: 100%;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black form-container">
                  <form method="post" action="process_login.php">

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0" style="font-size: 50px; color: #DF826C;">Flourish Craft</span>

                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                    <?php if(!empty($error)) { ?>
                      <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" name="f_username" id="username" class="form-control form-control-lg" />
                      <label class="form-label" for="username">Username</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="f_password" id="form2Example27" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block custom-button" type="submit" name="login">Login</button>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>
</html>