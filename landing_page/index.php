<!DOCTYPE html>
<html>
	<head>
	<title>E-Kids Learning Platform</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/landing-pg.css" rel="stylesheet" type="text/css" media="all" />
	<link href="https://fonts.googleapis.com/css?family=Short+Stack" rel="stylesheet"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  
	<script>
	$(document).ready(function(){
		
		$('#divTeacherCode').css("display","none");
		$('#divAdminCode').css("display","none");
		$('#divParent').css("display","none");
		
		$("#txtUserType").change(function(){
			//alert("changed");
			//alert($('#txtUserType').val());
			if($('#txtUserType').val()=="parent"){
				$('#divParent').css("display","block");
				$('#divTeacherCode').css("display","none");
				$('#divAdminCode').css("display","none");
			}
			else if($('#txtUserType').val()=="teacher"){
				$('#divParent').css("display","none");
				$('#divTeacherCode').css("display","block");
				$('#divAdminCode').css("display","none");						
			}
			else if($('#txtUserType').val()=="admin"){
				$('#divParent').css("display","none");
				$('#divTeacherCode').css("display","none");
				$('#divAdminCode').css("display","block");
			}
			else if($('#txtUserType').val()==""){
				$('#divTeacherCode').css("display","none");
				$('#divAdminCode').css("display","none");
				$('#divParent').css("display","none");
			}
		});
	});

	function validateFunction(){
		var actualPassword=document.getElementById("txtSignUpPassword").value;
		var confirmPassword=document.getElementById("txtSignUpConfirmPassword").value;
		
		if(actualPassword===confirmPassword){
			alert("same");
			return true
		}
		else{
			alert("shit");
			return false
		}
	}
	</script>
	</head>
	
	<body>
		<!-- top nav -->
		<nav class="navbar navbar-light bg-light justify-content-between">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			  </button>
			  <a class="navbar-brand" href="#">E-Kids Learning Platform</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<form method="POST" action="signIn.php" class="form-inline pull-right">
					<ul class="nav navbar-nav navbar-right">
						<li><input type="email" class="form-control" id="txtSignInEmail" name="txtSignInEmail" placeholder="Email"></li>
						<li><input type="password" class="form-control" id="txtSignInPassword" name="txtSignInPassword" placeholder="Password"></li>
						<li><input type="submit" class="form-control" value="Sign In"></li>
					 </ul>
				</form>
			</div>
		  </div>
		</nav>
		<!-- end of top nav -->
		
		<!-- content -->
		<section class="container">
		<div class="form-wrapper">
				<form method="POST" action="signUp.php" onsubmit="return validateFunction();">
				<div class="form-group">				
				<h2>Sign Up</h2>
				<div class="row">
					<div class="col-md-12">
						<label>Full Name</label>
						<input type="text" class="form-control" id="txtSignUpFullName" name="txtSignUpFullName" required="true">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Phone number</label>
						<input type="text" class="form-control" id="txtSignUpPhone" name="txtSignUpPhone">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Email</label>
						<input type="email" class="form-control" id="txtSignUpEmail" name="txtSignUpEmail" required="true">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Password</label>
						<input type="password" class="form-control" id="txtSignUpPassword" name="txtSignUpPassword">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Confirm Password</label>
						<input type="password" class="form-control" id="txtSignUpConfirmPassword" name="txtSignUpConfirmPassword">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>User Type</label>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="txtUserType" name="txtUserType">
							<option value=""></option>
							<option value="parent">Parent</option>
							<option value="teacher">Teacher</option>
							<option value="admin">Admin</option>
						</select>
					</div>
				</div>
				<div class="row" id="divTeacherCode">
					<div class="col-md-6">
						<label>Teacher Code</label>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" id="txtTeacherCode" name="txtTeacherCode">
					</div>
				</div>
				<div class="row" id="divAdminCode">
					<div class="col-md-6">
						<label>Admin Code</label>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" id="txtAdminCode" name="txtAdminCode">
					</div>
				</div>
				<div class="row" id="divParent">
					<div class="row" id="divChildName">
						<div class="col-md-12">
							<div class="col-md-6">
								<label>Child Full name</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" id="txtSignUpChildFullName" name="txtSignUpChildFullName">
							</div>
						</div>
						
					</div>
					<div class="row" id="divChildAge">
						<div class="col-md-12">
							<div class="col-md-6">
								<label>Child class</label>
							</div>
							<div class="col-md-6">
								<select class="form-control" name="txtChildClass">
								  <option value="0"></option>
								  <option value="grade1">Grade 1</option>
								  <option value="grade2">Grade 2</option>
								  <option value="grade3">Grade 3</option>
								  <option value="grade4">Grade 4</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input type="submit" class="btn btn-success pull-right" value="Sign Up">
					</div>
				</div>
				</div>
				</form>
			</div>
			<img class="pull-right" src="../img/round-eyes-cartoon-kids.jpg" alt="cartoon boy" height="60%" width="40%" style="max-width:100%;height:auto;"> 			
		</section>
		<!-- end of content -->
		<footer class="container-fluid">
			<div class="copyright">
				<p>ekids © 2018 | All Rights Reserved</p>
			</div>
		</footer>
	</body>
</html>