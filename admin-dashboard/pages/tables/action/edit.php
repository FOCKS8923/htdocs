<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cs_user_db";

$connection = new mysqli($servername, $username, $password, $database);

$Sno = "";
$user_name = "";
$mobile_no = "";
$email = "";
$password = "";

$errorMessage = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the client

    if ( !isset($_GET["Sno"]) ) {
        header("location: ../data.php");
        exit;
    }

    $Sno = $_GET["Sno"];

    //read the row of the selected client from database table
    $sql = "SELECT * FROM user_details WHERE Sno=$Sno";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if  (!$row) {
        header("location: ../data.php");
        exit;
    }
    $user_name = $row["user_name"];
    $mobile_no = $row["mobile_no"];
    $email = $row["email"];
    $password = $row["password"];
}
else {
    //POST method: Updtae the data of the client 
    $Sno = $_POST["Sno"];
    $user_name = $_POST["user_name"];
    $mobile_no = $_POST["mobile_no"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    do {
        if ( empty($Sno) || empty($user_name) || empty($mobile_no) || empty($email) || empty($password)){
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE user_details" . 
            "SET user_name = '$user_name', mobile_no = '$mobile_no', email = '$email', password = '$password' " . 
            "WHERE Sno = $Sno";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invailid Query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

        header("location: ../data.php");
        exit;

    } while (false);

}



?>



<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="../../../../css/create.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- Body of Form starts -->
  	<div class="container">
      <form method="post"autocomplete="on">
        <input type="hidden" name="Sno" value="<?php echo $Sno; ?>">
        <!--studen name-->
    		<div class="box">
          <label for="student_name" id="student_name" class="fl fontLabel">User Name: </label>
    			<div class="new iconBox">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
    			<div class="fr">
    					<input type="text" name="user_name" placeholder="User Name" class="textBox" autofocus="on" required value="<?php echo $user_name; ?>" >
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--user name-->

    		<!---Phone No.------>
    		<div class="box">
          <label for="mobile_no" class="fl fontLabel"> Mobile No.: </label>
    			<div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="mobile_no" maxlength="10" placeholder="Mobile No." class="textBox" value="<?php echo $mobile_no; ?>" >
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!---Phone No.---->


    		<!---Email---->
    		<div class="box">
          <label for="email" class="fl fontLabel"> Email: </label>
    			<div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="email" required name="email" placeholder="Email" class="textBox" value=" <?php echo $email; ?>">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--Email----->


    		<!---Password------>
    		<div class="box">
          <label for="password" class="fl fontLabel"> Password: </label>
    			<div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="password" placeholder="Password" class="textBox" value=" <?php echo $password; ?>">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!---Password---->



    		<!---Submit Button------>
    		<div class="box butn" style="background: #2d3e3f; margin-top: 40%">
    				<input type="submit" name="submit" class="submit" value="SUBMIT">
                    <a href="index.htm" class="back">Back</a>
    		</div>
    		<!---Submit Button----->
      </form>
  </div>
  <!--Body of Form ends--->
  </body>
</html>