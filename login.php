<?php

require 'config.php';

session_start();

if (isset($_POST['submit'])){
	$student_name = $_POST['student_name'];
	$father_name = $_POST['father_name'];
	$mobile_no = $_POST['mobile_no'];
	$student_id = $_POST['student_id'];
	$password = $_POST['password'];
	$user_type = $_POST['user_type'];


	$user = mysqli_query($conn, "SELECT * FROM login_details WHERE student_id = '$student_id' OR password = $password");
	if(mysqli_num_rows($user) > 0){
		$row = mysqli_fetch_array($user);

		if($row['user_type'] == 'admin'){

			$_SESSION['admin_name'] = $row['name'];
			header('location:admin-page.php');

		}elseif($row['user_type'] == 'student'){

			$_SESSION['student_name'] = $row['name'];
			header('location:student-page.php');

		}
            
	}else{
        $error[] = 'Incorrect ID or Password';
    }

}


?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login - Computer Science</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <!-- partial:index.partial.html -->
        <div class="page">


            <?php

            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg"> '.$error.' </span>';
                };
            };

            ?>


        <div class="container">
            <div class="left">
              <div class="login">Login</div>
              <div class="eula">By logging in you agree to the ridiculously long terms that you didn't bother to read</div>
              <div class="cancle"><a href="index.htm">Cancle</a></div>
            </div>
            <div class="right">
              <svg viewBox="0 0 320 300">
                <defs>
                  <linearGradient
                                  inkscape:collect="always"
                                  id="linearGradient"
                                  x1="13"
                                  y1="193.49992"
                                  x2="307"
                                  y2="193.49992"
                                  gradientUnits="userSpaceOnUse">
                    <stop
                          style="stop-color:#ff00ff;"
                          offset="0"
                          id="stop876" />
                    <stop
                          style="stop-color:#ff0000;"
                          offset="1"
                          id="stop878" />
                  </linearGradient>
                </defs>
                <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35-25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
              </svg>
              <div class="form">
                <label for="email">Student ID</label>
                <input type="email" name="student_id" id="email">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <input type="submit" id="submit" name="submit" value="Login">
              </div>
            </div>
          </div>
        </div>
        <!-- partial -->
        <script src='js/anime.min.js'></script>
        <script src="js/script.js"></script>
    </body>
</html>

