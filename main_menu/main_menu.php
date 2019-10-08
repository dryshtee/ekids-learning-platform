<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Courses</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Short+Stack" rel="stylesheet">
		<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" />

		<!-- Latest compiled and minified JavaScript -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		

		<script>
		function btnAction(courseSubject,courseClass,courseID){
		  document.getElementById('txtCourseSubject').value=courseSubject;
		  document.getElementById('txtCourseClass').value=courseClass;
		  document.getElementById('txtCourseID').value=courseID;
		  alert(courseSubject);
		  alert(courseClass);
		}
		function getStudentValue(theValue,theClass){
		  //alert(theValue);
		  document.getElementById('txtCourseClass').value=theClass;
		  getCourse(theClass);
		}
		function getCourse(theClass){
		  alert("getCourse");
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
			  document.getElementById("studentCourseDiv").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", "../main_menu/getSubjectByGrade.php?theClass="+theClass, true);
		  xhttp.send();
		}
		</script>
	</head>

	<body>

		<nav class="navbar navbar-light bg-light justify-content-between">
			<div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand" href="#">E-Kids Learning Platform</a>
				</div>
				<div class="dropdown">
				</br>
					<a class="dropdown-toggle pull-right" data-toggle="dropdown">
					Hello <?php echo $_SESSION["userFullName"] ?>
					<span class="caret"></span></a>
					<ul class="dropdown-menu pull-right">
					  <li><a href="../landing_page/signOut.php">Sign Out</a></li>
					</ul>
				</div>
				<!--<a href="../landing_page/signOut.php">Sign Out</a>
				<a class="nav-username">Hello <?php echo $_SESSION["userFullName"] ?></a>-->
			</div>
		</nav>

		<div class="container-fluid" id="content">
			<form method="GET" action="../main_page/index.php">
				<input type="text" id="txtCourseClass" name="txtCourseClass" hidden>
				<input type="text" id="txtCourseSubject" name="txtCourseSubject" hidden>
				<input type="text" id="txtCourseID" name="txtCourseID" hidden>

				<div class="col-md-6">			
					<?php
						$conn=mysqli_connect("localhost","root","","e_kids");
						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						else{
						?>
					<hr/>
					<div class="col-sm-5"> <!-- required for floating -->
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs tabs-left sideways">
					  <?php
						$getUserTypeQuery="SELECT userType FROM tbl_user WHERE userID=?";
						$getUserTypeStmt=$conn ->prepare($getUserTypeQuery);
						$getUserTypeStmt->bind_param('s',$_SESSION["userID"]);
						$getUserTypeStmt ->bind_result($userType_Col);
						$getUserTypeStmt ->execute();
						while($getUserTypeStmt ->fetch()){
							// echo $userType_Col;
						}
						if($userType_Col=='teacher'){
							echo "</br></br><li><a href='#createdCourses' data-toggle='tab' id='linkTeacher'>Courses you created</a></li>";
						}
						else if($userType_Col=='parent'){
							echo "</br></br><li><a href='#gradeCourses' data-toggle='tab' id='linkParent'>Courses for your Grade</a></li>";
						}
					  ?>
					  </ul>
					</div><!-- end of col-sm-3 -->
						
					<div class="col-sm-7">
					  <!-- Tab panes -->
					  <?php
						$getUserTypeQuery="SELECT userType FROM tbl_user WHERE userID=?";
						$getUserTypeStmt=$conn ->prepare($getUserTypeQuery);
						$getUserTypeStmt->bind_param('s',$_SESSION["userID"]);
						$getUserTypeStmt ->bind_result($userType_Col);
						$getUserTypeStmt ->execute();
						while($getUserTypeStmt ->fetch()){
							// echo $userType_Col;
						}
						if($userType_Col=='teacher'){
					  ?>
					  <div class="tab-content">
						<div class="" id="createdCourses">
							<p>hello teacher ! <input type="button" class="btn btn-success pull-right" id="btnCreateCourse" value="Create course" onclick="location.href = '../create_course/index.php'"></p>
							<br/>
							<?php		
							$getCourseIDQuery="SELECT courseID,courseSubject,courseClass FROM tbl_course WHERE creatorID=?";
							$getCourseIDStmt=$conn ->prepare($getCourseIDQuery);
							$getCourseIDStmt->bind_param('s',$_SESSION["userID"]);
							$getCourseIDStmt ->bind_result($courseID_Col,$courseSubject_Col,$courseClass_Col);
							$getCourseIDStmt ->execute();
							while($getCourseIDStmt ->fetch()){
							/*echo $courseID_Col;
							echo "<br/>";
							echo $courseSubject_Col;
							echo "<br/>";
							echo $courseClass_Col;*/
							?>
							<input type="submit" class="btn btn-primary" value="<?php echo $courseClass_Col." ".$courseSubject_Col;  ?>" onclick="btnAction('<?php echo $courseSubject_Col;  ?>','<?php echo $courseClass_Col;?>','<?php echo $courseID_Col; ?>')";>
							<?php
							}
							?>
						</div>
						<?php
						}
						else if($userType_Col=='parent'){
						?>
						<div class="" id="gradeCourses">
							<p>hello parent !</p>
							<label>Choose your child's name: </label>
							 <select id="childClassDropdown" name="childClassDropdown">
								<?php
								$getChildrenQuery="SELECT childID,childFullName,childClass,parentID FROM tbl_child WHERE parentID=?";
								$getChildrenStmt=$conn ->prepare($getChildrenQuery);
								$getChildrenStmt->bind_param('s',$_SESSION["userID"]);
								$getChildrenStmt ->bind_result($childID_Col,$childFullName_Col,$childClass_Col,$parentID_Col);
								$getChildrenStmt ->execute();
								while($getChildrenStmt ->fetch()){
									?>
									<option value="<?php echo $childFullName_Col; ?>" onclick="getStudentValue('<?php echo $childID_Col; ?>','<?php echo $childClass_Col; ?>');"><?php echo $childFullName_Col; ?></option>
									<?php
								}
								?>
							</select>
							</br></br>
							<div id="studentCourseDiv"></div>
						</div>
						<?php
						}
						?>
					  </div>

					</div><!-- end of col-sm-9 -->
					<div class="clearfix"></div>
				</div>
				<!-- end of container fluid -->
				<?php
					} //end of else for chking db connection
				?>
			</form>
		</div>

		<!-- start of nice img -->
		<img class="pull-right" src="../img/crayon.gif" alt="cartoon boy" height="20%" width="25%" style="max-width:100%;height:auto;">
		<!-- end of nice img -->
		<footer class="container-fluid">
			<div class="copyright">
				<p>ekids © 2018 | All Rights Reserved</p>
			</div>
		</footer>
	</body>
</html>