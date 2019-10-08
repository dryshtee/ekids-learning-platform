<?php
		$theClass=$_GET["theClass"];
		$conn=mysqli_connect("localhost","root","","e_kids");
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	else{
		$getChildQuery="SELECT courseID,courseSubject,courseClass
						FROM tbl_course
						WHERE courseClass=?";
		$getChildStmt=$conn ->prepare($getChildQuery);
		$getChildStmt->bind_param('s',$theClass);
		$getChildStmt->bind_result($courseID_Col,$courseSubject_Col,$courseClass_Col);
		$getChildStmt ->execute();
		while($getChildStmt ->fetch()){
			?>
			<input type="submit" class="btn btn-primary" value="<?php echo $courseClass_Col." ".$courseSubject_Col;  ?>" onclick="btnAction('<?php echo $courseSubject_Col;  ?>','<?php echo $courseClass_Col;?>','<?php echo $courseID_Col; ?>')";>
			<?php
		}
	}
?>