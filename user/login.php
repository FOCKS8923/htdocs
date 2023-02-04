<?php
session_start(); // Start the session

// Connect to the database
require '../config.php';
// Check for form submission
if (isset($_POST['login'])) {
    // Get the form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate the form data
    if (empty($email)) {
        $error = "Enter your email";
    } elseif (empty($password)) {
        $error = "Enter your password";
    } else {
        // Check the credentials against the database
        $query = "SELECT * FROM user_details WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Login successful
            $user = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            if(isset($_POST['remember'])) {
              // Create a remember me cookie if the checkbox is checked
              setcookie("email", $email, time() + (86400 * 30));
              setcookie("password", $password, time() + (86400 * 30));
          }
            header('location: student-page.php');
        } else {
            // Login failed
            $error = "Invalid credentials";
        }
    }
}

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    header('location: student-page.php');
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in Pannel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/loader.css">
    <script src="../js/preloader.js"></script>

</head>

<body onload="fpreloader()">

    <div id="preloader" class="preloader">
        <svg role="img"
            aria-label="Mouth and eyes come from 9:00 and rotate clockwise into position, right eye blinks, then all parts rotate and merge into 3:00"
            class="smiley" viewBox="0 0 128 128" width="128px" height="128px">
            <defs>
                <clipPath id="smiley-eyes">
                    <circle class="smiley__eye1" cx="64" cy="64" r="8" transform="rotate(-40,64,64) translate(0,-56)" />
                    <circle class="smiley__eye2" cx="64" cy="64" r="8" transform="rotate(40,64,64) translate(0,-56)" />
                </clipPath>
                <linearGradient id="smiley-grad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#000" />
                    <stop offset="100%" stop-color="#fff" />
                </linearGradient>
                <mask id="smiley-mask">
                    <rect x="0" y="0" width="128" height="128" fill="url(#smiley-grad)" />
                </mask>
            </defs>
            <g stroke-linecap="round" stroke-width="12" stroke-dasharray="175.93 351.86">
                <g>
                    <rect fill="hsl(193,90%,50%)" width="128" height="64" clip-path="url(#smiley-eyes)" />
                    <g fill="none" stroke="hsl(193,90%,50%)">
                        <circle class="smiley__mouth1" cx="64" cy="64" r="56" transform="rotate(180,64,64)" />
                        <circle class="smiley__mouth2" cx="64" cy="64" r="56" transform="rotate(0,64,64)" />
                    </g>
                </g>
                <g mask="url(#smiley-mask)">
                    <rect fill="hsl(223,90%,50%)" width="128" height="64" clip-path="url(#smiley-eyes)" />
                    <g fill="none" stroke="hsl(223,90%,50%)">
                        <circle class="smiley__mouth1" cx="64" cy="64" r="56" transform="rotate(180,64,64)" />
                        <circle class="smiley__mouth2" cx="64" cy="64" r="56" transform="rotate(0,64,64)" />
                    </g>
                </g>
            </g>
        </svg>
    </div>
    <form method="post" action="">
        <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
          <div class="col-lg-12 login-key">
            <i class="fa fa-key" aria-hidden="true"></i>
          </div>
          <div class="col-lg-12 login-title">
            LOGIN PANNEL
          </div>

          <div class="col-lg-12 login-form">
            <div class="col-lg-12 login-form">
              <form>
                <div class="form-group">
                  <label class="form-control-label" for="email">EMAIL</label>
                  <input value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>" type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label class="form-control-label" for="password">PASSWORD</label>
                  <input value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" type="password" class="form-control" id="password" name="password">
                </div>
                  <label for="remember" class="login-text">Remember me</label>
                  <input type="checkbox" id="remember" name="remember">

                <div class="col-lg-12 loginbttm">
                  <div class="col-lg-6 login-btm login-text">
                  <?php if (isset($error)) { ?>
                  <p><?php echo $error; ?></p>
                  <?php } ?>
                  </div>
                  <div class="col-lg-6 login-btm login-button">
                    <button type="submit" class="btn btn-outline-primary" name="login">LOGIN</button>
                    <a href="../index.htm" class="btn btn-outline-primary">BACK</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-3 col-md-2"></div>
        </div>
      </div>
    </form>
</body>

</html>