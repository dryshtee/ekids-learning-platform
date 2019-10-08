<?php
$userMail=$_POST["txtSignInEmail"];
$userPassword=$_POST["txtSignInPassword"];

/*echo $userMail;
echo "<br/>";
echo $userPassword;*/

// Check connection
$conn = mysqli_connect("localhost","root","","e_kids");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
	  $hashedPassword=md5($userPassword, TRUE);
	  $getUserQuery="SELECT userID, userFullName, userEmail FROM tbl_user WHERE userEmail=? AND userPassword=?";
	  $getUserStmt=$conn->prepare($getUserQuery);
	  $getUserStmt->bind_param("ss",$userMail,$hashedPassword);
	  $getUserStmt->execute();
	  $getUserStmt->bind_result($userID_Col,$userFullName_Col,$userEmail_Col);
	  while ($getUserStmt ->fetch()) {
		  //echo $userID_Col;
		  session_start();
		  $_SESSION["userID"]=$userID_Col;
		  $_SESSION["userFullName"]=$userFullName_Col;
		  $_SESSION["email"]=$userEmail_Col;
	  }
	  if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
		   header('Location: ../main_menu/main_menu.php');
		   die();
	  }
	  else{
		  header('Location: ../landing_page/index.php');
	  }
  }
?>