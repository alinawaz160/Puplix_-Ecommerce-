<?php
require("connection.inc.php");
require("functions.inc.php");
$msg = '';
$color = 'red';
if (isset($_POST['login_submit'])) {
  $email = get_safe_value($con, $_POST['email']);
  $password = get_safe_value($con, $_POST['password']);
  $sql = "select * from admin_users where email = '$email' and password='$password'";
  $res = mysqli_query($con, $sql);
  if (!$res) {
    die("Query failed: " . mysqli_error($con));
  }
  $count = mysqli_num_rows($res);
  if ($count > 0) {
    $_SESSION['ADMIN_LOGIN'] = 'yes';
    $_SESSION['ADMIN_EMAIL'] = $email;
    header("location:/puplix/admin");
  } else {
    $msg = 'Please enter correct login details';
    $color = 'red';
  }
}

if (isset($_POST['signup_submit'])) {
  $name = get_safe_value($con, $_POST['name']);
  $email = get_safe_value($con, $_POST['email']);
  $password = get_safe_value($con, $_POST['password']);

  // Check if the email is already registered
  $check_email_sql = "SELECT * FROM admin_users WHERE email = '$email'";
  $check_email_res = mysqli_query($con, $check_email_sql);
  $email_count = mysqli_num_rows($check_email_res);

  if ($email_count > 0) {
    $msg = 'Email already registered. Please use a different email.';
  } else {
    // Insert the new user into the database
    $insert_user_sql = "INSERT INTO admin_users (name, email, password) VALUES ('$name', '$email', '$password')";
    $insert_user_res = mysqli_query($con, $insert_user_sql);

    if ($insert_user_res) {
      $msg = 'Sign-up success. You can now login';
      $color = 'green';
    } else {
      $msg = 'Signup failed. Please try again later.';
      $color = 'red';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Login and Registration Form in HTML & CSS | CodingLab </title>
  <link rel="stylesheet" href="../style.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="../pet_store(n)/th (24).jpeg" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
          <form method="post" action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Submit" name="login_submit">
              </div>
              <div style="color:<?php echo $color ?>;margin-top:10px">
                <?php echo $msg ?>
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
            </div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">Signup</div>
          <form method="post" action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" name="signup_submit">
              </div>
              <div style="color:<?php echo $color ?>;margin-top:10px">
                <?php echo $msg ?>
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>