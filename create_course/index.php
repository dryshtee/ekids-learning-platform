<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Create Course</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="../css/course.css" rel="stylesheet" type="text/css" media="all" />
		<link href="https://fonts.googleapis.com/css?family=Short+Stack" rel="stylesheet"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<style>
		div{
			margin-top:3px;
		}
		</style>
		<script>
			var numberOfQuestion=0;
			var questionNumber=0;
			var lastElementToDisplay=0;
			
			var courseSubject="";
			var titleArray=[];
			var urlArray=[];
			var questionArray=[];
			var optionA_Array=[];
			var optionB_Array=[];
			var optionC_Array=[];
			var optionD_Array=[];
			var correctAnswerArray=[];
			var passingMarkArray=[];
			
			$(document).ready(function(){
				document.getElementById("txtQuestionNumber").value=questionNumber;
				$('#btnProceed').click(function(){
				   $('#divCreateContent').css("display","inline");
				   $('#divGeneralInformation').css("display","none");
				   
				   var getNumberOfQuestion = document.getElementById("txtNumberOfQuestions");
				   numberOfQuestion = getNumberOfQuestion.options[getNumberOfQuestion.selectedIndex].value;
				   document.getElementById("txtQuestionNumber").innerHTML=questionNumber;
					
				   numberOfQuestion=numberOfQuestion.substring(2);
				   alert(numberOfQuestion);
				   
				   var getCourseSubject=document.getElementById("txtSubject").value;
				   courseSubject = getCourseSubject.options[getCourseSubject.selectedIndex].value;
				   alert(courseSubject);
			   }); //end of btnProceed
			});
			function functionNext(){
				alert("next clicked");
				if(questionNumber<numberOfQuestion){
					//if array length less than number of question then dreC
					titleArray[questionNumber]=document.getElementById("txtTitle").value;
					urlArray[questionNumber]=document.getElementById("txtVideoLink").value;
					questionArray[questionNumber]=document.getElementById("txtQuesion").value;
					optionA_Array[questionNumber]=document.getElementById("txtOptionA").value;
					optionB_Array[questionNumber]=document.getElementById("txtOptionB").value;
					optionC_Array[questionNumber]=document.getElementById("txtOptionC").value;
					optionD_Array[questionNumber]=document.getElementById("txtOptionD").value;
					correctAnswerArray[questionNumber]=document.getElementById("txtCorrectAnswer").value;
					
					//alert(questionNumber);
					//alert(correctAnswerArray[questionNumber]);
					
					questionNumber=questionNumber+1;
					//lastElementToDisplay=questionNumber;
					
					alert(questionNumber);
					alert(lastElementToDisplay);
				}
				else{
					alert("exceeded");
				}
				
			}
			function saveFunction(){
					titleArray[questionNumber]=document.getElementById("txtTitle").value;
					urlArray[questionNumber]=document.getElementById("txtVideoLink").value;
					questionArray[questionNumber]=document.getElementById("txtQuesion").value;
					optionA_Array[questionNumber]=document.getElementById("txtOptionA").value;
					optionB_Array[questionNumber]=document.getElementById("txtOptionB").value;
					optionC_Array[questionNumber]=document.getElementById("txtOptionC").value;
					optionD_Array[questionNumber]=document.getElementById("txtOptionD").value;
					correctAnswerArray[questionNumber]=document.getElementById("txtCorrectAnswer").value;
					
					questionNumber=questionNumber+1;
			}
			function viewNext(){
					questionNumber=questionNumber+1;
					document.getElementById("txtTitle").value=titleArray[questionNumber];
					document.getElementById("txtVideoLink").value=urlArray[questionNumber];
					document.getElementById("txtQuesion").value=questionArray[questionNumber];
					document.getElementById("txtOptionA").value=optionA_Array[questionNumber];
					document.getElementById("txtOptionB").value=optionB_Array[questionNumber];
					document.getElementById("txtOptionC").value=optionC_Array[questionNumber];
					document.getElementById("txtOptionD").value=optionD_Array[questionNumber];
					document.getElementById("txtCorrectAnswer").value=correctAnswerArray[questionNumber];
			}
			function saveAndNextFunction(){
				//functionNext();
				//functionReset();
				alert("saveAndNextFunction()");
				//alert(titleArray[questionNumber]);
				if(titleArray[questionNumber]===undefined){
					alert("undefined");
					saveFunction();
					functionReset();
				}
				else{
					alert("defined");
					viewNext();
				}
			}
			function functionPrevious(){
					questionNumber=questionNumber-1;
					
					document.getElementById("txtTitle").value=titleArray[questionNumber];
					document.getElementById("txtVideoLink").value=urlArray[questionNumber];
					document.getElementById("txtQuesion").value=questionArray[questionNumber];
					document.getElementById("txtOptionA").value=optionA_Array[questionNumber];
					document.getElementById("txtOptionB").value=optionB_Array[questionNumber];
					document.getElementById("txtOptionC").value=optionC_Array[questionNumber];
					document.getElementById("txtOptionD").value=optionD_Array[questionNumber];
					document.getElementById("txtCorrectAnswer").value=correctAnswerArray[questionNumber];
					//lastElementToDisplay--;
			}
			function functionReset(){
					document.getElementById("txtTitle").value="";
					document.getElementById("txtVideoLink").value="";
					document.getElementById("txtQuesion").value="";
					document.getElementById("txtOptionA").value="";
					document.getElementById("txtOptionB").value="";
					document.getElementById("txtOptionC").value="";
					document.getElementById("txtOptionD").value="";
					document.getElementById("txtCorrectAnswer").value="";
			}
			function loadDoc() {
				var courseSubject=document.getElementById("txtSubject").value;
				var courseClass=document.getElementById("txtGrade").value;
				//var courseNumberOfQuestion=document.getElementById("txtNumberOfQuestions").value;
				
				var xhttp = new XMLHttpRequest();
				var myJSON = JSON.stringify(titleArray);
				alert(myJSON);
				
				var display2 = {};
				for(var a=0;a<titleArray.length;a++){
					display2[a]=titleArray[a];
				}
				var myJSON1 = JSON.stringify(display2);
				var obj = JSON.parse(myJSON1);
				alert(myJSON1);
				alert(obj);
				
				var testArray=[];
				for(var i=0;i<titleArray.length;i++){
					var obj = {
						'title':titleArray[i],
						'URL':urlArray[i],
						'question':questionArray[i],
						'optionA':optionA_Array[i],
						'optionB':optionB_Array[i],
						'optionC':optionC_Array[i],
						'optionD':optionD_Array[i],
						'correctAnswer':correctAnswerArray[i]
					}
					testArray.push(obj);
				}
				alert(JSON.stringify(testArray));
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  document.getElementById("divResponse").innerHTML = this.responseText;
				  //alert(this.responseText);
				}
			  };
			  
			  xhttp.open("POST", "saveCourse.php", true);
			  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  //xhttp.send("titleArray="+JSON.stringify(testArray));
			  xhttp.send("titleArray="+JSON.stringify(testArray)+"&courseSubject="+courseSubject+"&courseClass="+courseClass+"&numberOfQuestion="+numberOfQuestion);
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
				<form>
					<ul class="nav navbar-nav navbar-right">
						<h4><?php echo $_SESSION["userFullName"] ?></h4>
					 </ul>
				</form>
			</div>
		  </div>
		</nav>
		<!-- end of top nav -->
		<h3>Create your course</h3>
		<div class="container" id="formContent">
		<form method="POST">
			<div id="divResponse"></div>
			<div class="container" id="divGeneralInformation">
				<div class="row">
					<div class="col-md-6">
						<label>Choose your subject :</label>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="txtSubject">
						  <option value="english">English</option>
						  <option value="french">French</option>
						  <option value="science">Science</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Choose your class :</label>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="txtGrade">
							<option value="grade1">Grade 1</option>
							<option value="grade2">Grade 2</option>
							<option value="grade3">Grade 3</option>
							<option value="grade4">Grade 4</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Number of questions :</label>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="txtNumberOfQuestions">
							<option value="Qu1">1</option>
							<option value="Qu2">2</option>
							<option value="Qu3">3</option>
							<option value="Qu4">4</option>
							<option value="Qu5">5</option>
						</select>
					</div>
				</div>
				
				<div class="row"></br>
				<hr>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3">
						<input type="button" class="btn btn-default" id="btnProceed" value="Proceed" style="width:100%">
					</div>
				</div>
			</div>
			<!-- End of general information -->
			
			<div class="container" id="divCreateContent" style="display:none">
				<div id="divQuestionNumber" class="row">
					<div class="col-md-6">
						<label>Question Number: </label>
					</div>
					<div class="col-md-6">
						<input type="number" class="form-control" id="txtQuestionNumber">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Chapter Title</label>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" id="txtTitle" style="width:100%">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Enter YouTube URL of related video</label>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" id="txtVideoLink" style="width:100%">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Enter the quesion for the assessment</label>
						<textarea id="txtQuesion" class="form-control" row="3" style="width:100%"></textarea>
					</div>
				</div>
				<div id="divAnswers">
					<div class="row">
						<div class="col-md-6">
							<label>Enter the 4 possible answers</label>
						</div>
					</div>
					<div class="row"> <!-- option A and B -->
						<div class="col-md-6">
							<input type="text" id="txtOptionA" class="form-control" style="width:100%">
						</div>
						<div class="col-md-6">
							<input type="text" id="txtOptionB" class="form-control" style="width:100%">
						</div>
					</div><!-- end of option A and B -->
					<div class="row"> <!-- option C and D -->
						<div class="col-md-6">
							<input type="text" id="txtOptionC" class="form-control" style="width:100%">
						</div>
						<div class="col-md-6">
							<input type="text" id="txtOptionD" class="form-control" style="width:100%">
						</div>
					</div><!-- end of option C and D -->
				</div>
				<div class="row" id="divCorrectAnswer">
					<div class="col-md-12">
						<label>Enter the correct answer for the question</label>
					</div></br>
					<div class="col-md-6">
						<input type="text" class="form-control" id="txtCorrectAnswer" style="width:100%">
					</div>
				</div>
				<!--<div class="row" id="divNextOnly">
					<div class="col-md-9"></div>
					<div class="col-md-3">
						<button type="button" class="btn btn-default pull-right" id="btnNextOnly" value="Next">
						<span class="glyphicon glyphicon-arrow-right"></span>
						</button>					
					</div>
				</div>-->
				<div class="row" id="divPreviousNext">
				<hr>
					<div class="col-md-6"></div>
					<div class="col-md-3">
						<input type="button" class="btn btn-primary" id="btnPrevious" value="Previous Question" style="width:100%" onclick="functionPrevious()">
					</div>
					<div class="col-md-3">
						<input type="button" class="btn btn-primary" id="btnNext" value="Next Question" style="width:100%" onclick="saveAndNextFunction();">
					</div>
				</div>	
				<div class="row">
					<div class="col-md-9"></div>
					<div class="col-md-3">						
						<input type="button" class="btn btn-success" id="btnSubmit" value="Submit" style="width:100%" onclick="loadDoc();">
					</div>
				</div>
			</div>
		</form>
		</div>
		<!-- end of everything -->
		<!--<img class="pull-right" src="../img/crayon.gif" alt="crayon" height="25%" width="20%">-->

		<footer class="container-fluid">
			<div class="copyright">
				<p>ekids © 2018 | All Rights Reserved</p>
			</div>
		</footer>
	</body>
</html>