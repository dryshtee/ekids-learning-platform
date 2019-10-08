<?php
$userFullName=$_POST["txtSignUpFullName"];
$userPhoneNumber=$_POST["txtSignUpPhone"];
$userEmail=$_POST["txtSignUpEmail"];
$userPassword=$_POST["txtSignUpPassword"];
$userType=$_POST["txtUserType"];

$userID="U".rand(10000,1000000).$userPhoneNumber;
/*
Here we insert in tbl user
*/
$conn = mysqli_connect("localhost","root","","e_kids");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
	  /*$hashedPassword=md5($userPassword, TRUE);
	  $insertUserQuery="INSERT INTO tbl_user(userID, userFullName, userEmail, userPhoneNumber, userPassword, userType) VALUES(?, ?, ?, ?, ?, ?)";
	  $insertUserStmt=$conn->prepare($insertUserQuery);
	  $insertUserStmt->bind_param('ssssss',$userID,$userFullName,$userEmail,$userPhoneNumber,$hashedPassword,$userType);
	  $insertUserStmt->execute();*/
  }
echo $userID;
//echo $_POST["txtUserType"];
echo "<br/>";
if($userType=='parent'){
	$childName=$_POST["txtSignUpChildFullName"];
	$childClass=$_POST["txtChildClass"];
	echo $childName;
	echo "<br/>";
	echo $childClass;
	/*
	here we insert in parent and child tbl
	*/
	//here we insert in tbl child
	
	//let's chk if parent already exist.
	//if he does, register only the child
	//creating a many to one relationship
	$isPresent=false;
	$parentIDPresent;
	//$isParentPresentQuery="SELECT parentID,parentFullName FROM tbl_parent WHERE parentFullName=?";
	$isParentPresentQuery="SELECT u.userID, u.userEmail,u.userType,
							p.parentID, p.parentFullName, p.childID
							FROM tbl_user u
							LEFT JOIN tbl_parent p
							ON p.parentID=u.userID
							WHERE u.userEmail=?";
	$isParentPresentStmt=$conn->prepare($isParentPresentQuery);
	//$isParentPresentStmt->bind_param('s',$userFullName);
	$isParentPresentStmt->bind_param('s',$userEmail);
	//$userID_Col, $userEmail_Col,$userType_Col,$parentID_Col, $parentFullName_Col, $childID_Col
	//$isParentPresentStmt ->bind_result($parentID_Col,$parentFullName_Col);
	$isParentPresentStmt ->bind_result($userID_Col, $userEmail_Col,$userType_Col,$parentID_Col, $parentFullName_Col, $childID_Col);
	$isParentPresentStmt ->execute();
	while($isParentPresentStmt ->fetch()){
		$isPresent=true;
		$parentIDPresent=$parentID_Col;
	}
	

	if($isPresent==true){
		//do nothing
		$childID="C".rand(10000,1000000).$userPhoneNumber;
		$insertChildQuery="INSERT INTO tbl_child(childID, childFullName, childClass, parentID) VALUES (?, ?, ?, ?)";
		$insertChildStmt=$conn->prepare($insertChildQuery);
		$insertChildStmt->bind_param('ssss',$childID,$childName,$childClass,$parentIDPresent);
		$insertChildStmt->execute();
	}
	else{
		$parentID="P".rand(10000,1000000).$userPhoneNumber;
		$childID="C".rand(10000,1000000).$userPhoneNumber;
		
		$hashedPassword=md5($userPassword, TRUE);
		$insertUserQuery="INSERT INTO tbl_user(userID, userFullName, userEmail, userPhoneNumber, userPassword, userType) VALUES(?, ?, ?, ?, ?, ?)";
		$insertUserStmt=$conn->prepare($insertUserQuery);
		$insertUserStmt->bind_param('ssssss',$parentID,$userFullName,$userEmail,$userPhoneNumber,$hashedPassword,$userType);
		$insertUserStmt->execute();
		
		$insertParentQuery="INSERT INTO tbl_parent(parentID, parentFullName, childID) VALUES (?,?,?)";
		$insertParentStmt=$conn->prepare($insertParentQuery);
		$insertParentStmt->bind_param('sss',$parentID,$userFullName,$childID);
		$insertParentStmt->execute();
		
		
		$insertChildQuery="INSERT INTO tbl_child(childID, childFullName, childClass, parentID) VALUES (?, ?, ?, ?)";
		$insertChildStmt=$conn->prepare($insertChildQuery);
		$insertChildStmt->bind_param('ssss',$childID,$childName,$childClass,$parentID);
		$insertChildStmt->execute();
	}

	
	//let's insert in parent tbl
}
else if($userType=='admin'){
	$adminCode=$_POST["txtAdminCode"];
	echo $adminCode;
	/*
	here we insert in admin tbl
	*/
	$adminID="A".rand(10000,1000000).$userPhoneNumber;
	$insertAdminQuery="INSERT INTO tbl_admin(adminID, userID) VALUES (?, ?)";
	$insertAdminStmt=$conn->prepare($insertAdminQuery);
	$insertAdminStmt->bind_param('ss',$adminID,$userID);
	$insertAdminStmt->execute();
	
	$hashedPassword=md5($userPassword, TRUE);
	$insertUserQuery="INSERT INTO tbl_user(userID, userFullName, userEmail, userPhoneNumber, userPassword, userType) VALUES(?, ?, ?, ?, ?, ?)";
	$insertUserStmt=$conn->prepare($insertUserQuery);
	$insertUserStmt->bind_param('ssssss',$adminID,$userFullName,$userEmail,$userPhoneNumber,$hashedPassword,$userType);
	$insertUserStmt->execute();
}
else if($userType=='teacher'){
	$teacherCode=$_POST["txtTeacherCode"];
	echo $teacherCode;
	/*
	here we insert in teacher tbl
	*/
	$teacherID="T".rand(10000,1000000).$userPhoneNumber;
	$insertTeacherQuery="INSERT INTO tbl_teacher(teacherID, userID) VALUES (?, ?)";
	$insertTeacherStmt=$conn->prepare($insertTeacherQuery);
	$insertTeacherStmt->bind_param('ss',$teacherID,$userID);
	$insertTeacherStmt->execute();
	
	$hashedPassword=md5($userPassword, TRUE);
	$insertUserQuery="INSERT INTO tbl_user(userID, userFullName, userEmail, userPhoneNumber, userPassword, userType) VALUES(?, ?, ?, ?, ?, ?)";
	$insertUserStmt=$conn->prepare($insertUserQuery);
	$insertUserStmt->bind_param('ssssss',$teacherID,$userFullName,$userEmail,$userPhoneNumber,$hashedPassword,$userType);
	$insertUserStmt->execute();
}
?>
