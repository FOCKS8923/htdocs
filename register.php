<?php

require 'config.php';

if (isset($_POST['submit'])){
	$student_name = $_POST['student_name'];
	$mobile_no = $_POST['mobile_no'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$user_type = $_POST['user_type'];


	$user = mysqli_query($conn, "SELECT * FROM login_details WHERE email = '$email' OR student_name = '$student_name' OR father_name = '$father_name'");
	if(mysqli_num_rows($user) > 0){
		echo
			"<script> 
				alert('Student already Registered Try loging In')
			</script>";
	}
	else{
		$query = "INSERT INTO login_details VALUES(0,'$student_name','$father_name',$mobile_no,$email,'$password','$user_type')";
		mysqli_query($conn, $query);
		echo
			"<script> 
				alert('Registration Successfull')
			</script>";
	}
}


?>



<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="css/register.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- Body of Form starts -->
  	<div class="container">
      <form method="post" autocomplete="on">
        <!--studen name-->
    		<div class="box">
          <label for="student_name" id="student_name" class="fl fontLabel">Student Name: </label>
    			<div class="new iconBox">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
    			<div class="fr">
    					<input type="text" name="student_name" placeholder="Student Name"
              class="textBox" autofocus="on" required>
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--student name-->


        <!--father name-->
    		
    		<!--father name-->


    		<!---Phone No.------>
    		<div class="box">
          <label for="mobile_no" class="fl fontLabel"> Mobile No.: </label>
    			<div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="mobile_no" maxlength="10" placeholder="Mobile No." class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!---Phone No.---->


    		<!---Student ID---->
    		<div class="box">
          <label for="email" class="fl fontLabel"> Email: </label>
    			<div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="number" required name="email" placeholder="Email" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--Student ID----->


    		<!---Password------>
    		<div class="box">
          <label for="password" class="fl fontLabel"> Password: </label>
    			<div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="password" placeholder="Password" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!---Password---->

    		<!---Role----->
    		<div class="box radio">
          <label for="gender" class="fl fontLabel"> Role: </label>
    				<input type="radio" name="user_type" value="student" required> User &nbsp; &nbsp; &nbsp; &nbsp;
    				<input type="radio" name="user_type" value="admin" required> Admin
    		</div>
    		<!---Role--->


    		<!--Terms and Conditions------>
    		<div class="box terms">
    				<input type="checkbox" name="Terms" required> &nbsp; I accept the terms and conditions
    		</div>
    		<!--Terms and Conditions------>



    		<!---Submit Button------>
    		<div class="box" style="background: #2d3e3f">
    				<input type="submit" name="submit" class="submit" value="SUBMIT">
                    <a href="index.htm" class="back">Back</a>
    		</div>
    		<!---Submit Button----->
      </form>
  </div>
  <!--Body of Form ends--->
  </body>
</html>