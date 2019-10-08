<?php
session_start();

$courseID=$_POST["courseID"];
$courseClass=$_POST["courseClass"];
$couseSubject=$_POST["couseSubject"];
$numberOfCorrectAnswer=$_POST["numberOfCorrectAnswer"];
$numberOfWrongAnswer=$_POST["numberOfWrongAnswer"];
$studentPercentage=$_POST["studentPercentage"];
$resultOutcome=$_POST["resultOutcome"];
$studentName=$_POST["studentName"];

$emailBody="Hello, \n Your child: ".$studentName." has completed the course: ".$couseSubject." for ".$courseClass." with a percentage score of: ".$studentPercentage." \n Your child has: ".$resultOutcome." with ".$numberOfCorrectAnswer." correct answers and ".$numberOfWrongAnswer." wrong answers";

$conn=mysqli_connect("localhost","root","","e_kids");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
$getEmailQuery="SELECT userID,userEmail
				FROM tbl_user
				WHERE userID=?
				";	
$getEmailStmt=$conn ->prepare($getEmailQuery);

$getEmailStmt->bind_param("s",$_SESSION["userID"]);

$getEmailStmt ->bind_result($userID_Col,$userEmail);

$getEmailStmt ->execute();
	$parentMail="";
while ($getEmailStmt ->fetch()) {
	$parentMail=$userEmail;
}
echo $parentMail;
echo $emailBody;
mail($parentMail,"Your child result",$emailBody);
				
}

?>