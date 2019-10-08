<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Short+Stack" rel="stylesheet">
		<link rel="stylesheet" href="../css/main.css">
		
		<!--JS-->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="yt-player.js"></script>
		
		<script>
		var currentID="";
		var oldID="";
		var theValues;
		
		var chapterTitle=[];
		var url=[];
		var question=[];
		var optionA=[];
		var optionB=[];
		var optionC=[];
		var optionD=[];
		var correctAnswer=[];
		
		var count=0;
		
		$(document).ready(function(){
			//var theValues=retrieveInformation();
			//alert(theValues); 
			retrieveInformation();
			$('#videoembed').css("display","none");
			$('#divTutorial').css("display","none");				
			
		});
		function retrieveInformation(){
			var couseSubject=document.getElementById("txtCourseSubject").value;
			var courseClass=document.getElementById("txtCourseClass").value;
			var courseID=document.getElementById("txtCourseID").value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					 //alert(this.responseText);
					 theValues=this.responseText;
					 //alert(theValues[0].optionA);
					 //alert(theValues);
					 splitElements(theValues);
				}
			};
			xhttp.open("GET", "retrieveCourse.php?courseSubject="+couseSubject+"&courseClass="+courseClass+"&courseID="+courseID, true);
			xhttp.send();
			
			//return this.responseText;
		}
		
		function splitElements(theValues){
			alert(theValues);
			var courseContent = JSON.parse(theValues);
			//alert(obj);
			alert(courseContent[0].optionA);
			count = Object.keys(courseContent).length;
			alert(count);
			for(var i=0;i<count;i++){
				chapterTitle[i]=courseContent[i].chapterTitle;
				url[i]=courseContent[i].url;
				question[i]=courseContent[i].question;
				optionA[i]=courseContent[i].optionA;
				optionB[i]=courseContent[i].optionB;
				optionC[i]=courseContent[i].optionC;
				optionD[i]=courseContent[i].optionD;
				correctAnswer[i]=courseContent[i].correctAnswer;
			}
			createTblContent();
		}
		
		function createTblContent(){
			for(var i=0;i<count;i++){
				var para = document.createElement("p");
				para.setAttribute("id", chapterTitle[i]);
								
				var node = document.createTextNode(chapterTitle[i]);
				para.appendChild(node);
						

				var element = document.getElementById("divCourseContent");
				element.appendChild(para);
				
				
				//
				var videoID="video"+i;
				var videoDiv=document.createElement("p");
				videoDiv.setAttribute("id", videoID);
				videoDiv.onclick = function() {
				  // onclick stuff
				  loadVideoFunction(this.id);
				  $('#videoembed').css("display","block");
				  $('#divWelcome').css("display","none");
				  $('#divTutorial').css("display","none");					  
				}
				
				var videoNode = document.createTextNode(videoID);
				videoDiv.appendChild(videoNode);
				
				element.appendChild(videoDiv);
				
				//
				var questionID="question"+i;
				var questionDiv=document.createElement("p");
				questionDiv.setAttribute("id", questionID);
				questionDiv.onclick = function() {
				  // onclick stuff
				  loadQuestionFunction(this.id);
				  $('#videoembed').css("display","none");
				  $('#divWelcome').css("display","none");
				  $('#divTutorial').css("display","block");					  
				}
				
				var questionNode = document.createTextNode(question[i]);
				questionDiv.appendChild(questionNode);
				
				element.appendChild(questionDiv);
				
			}
			//after populating the course, let's put the button to submit the questionnaire 
			var submitQuestionnaireID="btnSubmit";
			var submitQuestionnaireDiv=document.createElement("p");
			submitQuestionnaireDiv.setAttribute("id", submitQuestionnaireID);
			submitQuestionnaireDiv.onclick = function() {
				  // onclick stuff
				  questionnaireCorrectionFunction();
			}
			var submitQuestionnaireNode = document.createTextNode("Submit Questionnaire");
			submitQuestionnaireDiv.appendChild(submitQuestionnaireNode);
			element.appendChild(submitQuestionnaireDiv);
			
		}
		var theArrayPosition;
		var theVideoArrayPosition;
		var learnerAnswer=[];
		//var theLastDroppedItem;
		
		function loadQuestionFunction(id){
			alert("testFunction: "+id);
			theArrayPosition=id.substring(8);
			alert(id.substring(8));
			document.getElementById("divAnswerArea").innerHTML="";
			document.getElementById("confirmationText").innerHTML="";
			document.getElementById("questionParagraph").innerHTML=question[theArrayPosition];
			document.getElementById("answer1").innerHTML=optionA[theArrayPosition];
			document.getElementById("answer2").innerHTML=optionB[theArrayPosition];
			document.getElementById("answer3").innerHTML=optionC[theArrayPosition];
			document.getElementById("answer4").innerHTML=optionD[theArrayPosition];
		}
		function loadVideoFunction(id){
			alert("testFunction: "+id);
			theVideoArrayPosition=id.substring(5);
			alert(theVideoArrayPosition);
			var theVideoArrayURL=url[theVideoArrayPosition];
			alert(theVideoArrayURL);
			myVideoLink(theVideoArrayURL);
		}
		function submitTutorialAnswer(){
			//document.getElementById("divAnswerArea").children[0].text;
			learnerAnswer[theArrayPosition]=document.getElementById("divAnswerArea").children[0].innerHTML;
			document.getElementById("confirmationText").innerHTML="Your answer has been recorded";
			alert(document.getElementById("divAnswerArea").children[0].innerHTML);
		}
		function questionnaireCorrectionFunction(){
			var wrongAnswers=[];
			var numberOfCorrectAnswer=0;
			var numberOfWrongAnswer=0;
			
			for(var i=0;i<correctAnswer.length;i++){
				if(correctAnswer[i]==learnerAnswer[i]){
					numberOfCorrectAnswer=numberOfCorrectAnswer+1;
				}
				else{
					numberOfWrongAnswer=numberOfWrongAnswer+1;
					wrongAnswers[i]=i+1;
				}
				
			}
			alert("Total correct answer: "+numberOfCorrectAnswer);
			var studentPercentage= (numberOfCorrectAnswer/(numberOfCorrectAnswer+numberOfWrongAnswer))*100;
			var resultOutcome;
			if(studentPercentage>=50){
				resultOutcome="Success";
				alert(resultOutcome);
			}
			else{
				resultOutcome="Fail";
				alert(resultOutcome);
			}
			mailPrep(numberOfCorrectAnswer,numberOfWrongAnswer,studentPercentage,resultOutcome);
		}
		function mailPrep(numberOfCorrectAnswer,numberOfWrongAnswer,studentPercentage,resultOutcome){
			var couseSubject=document.getElementById("txtCourseSubject").value;
			var courseClass=document.getElementById("txtCourseClass").value;
			var courseID=document.getElementById("txtCourseID").value;
			var studentName=document.getElementById("txtStudentName").value;
			
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  //document.getElementById("demo").innerHTML = this.responseText;
				  alert(this.responseText);
				}
			  };
			  xhttp.open("POST", "../send_mail/senMailResult.php", true);
			  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  xhttp.send("courseID="+courseID+"&courseClass="+courseClass+"&couseSubject="+couseSubject+"&numberOfCorrectAnswer="+numberOfCorrectAnswer+"&numberOfWrongAnswer="+numberOfWrongAnswer+"&studentPercentage="+studentPercentage+"&resultOutcome="+resultOutcome+"&studentName="+studentName);
			
		}
		function allowDrop(ev) {
			document.getElementById("divAnswerArea").innerHTML = "";
			ev.preventDefault();
		}

		function drag(ev, theDiv) {
			ev.dataTransfer.setData("text", ev.target.id);
			if(oldID==""){
				oldID=theDiv;
				currentID=theDiv;
			}
			else{
				currentID=theDiv;
			}
		}

		function drop(ev) {
			
				ev.preventDefault();
			var data = ev.dataTransfer.getData("text");
			//ev.target.appendChild(document.getElementById(data));
			var nodeCopy = document.getElementById(data).cloneNode(true);
		  //nodeCopy.id = "newId"; /* We cannot use the same ID */
		  ev.target.appendChild(nodeCopy);
		}
		function reset(){
			document.getElementById("divAnswerOption").reset();
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
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row"> 
			<div class="col-sm-8">
				<div id="divWelcome">
					<center><img class="welcome" src="../img/welcome-banner.gif" alt="welcome"></br>
					<img class="fun" src="../img/fun.jpg" alt="fun"></center>
				</div>
				<input type="text" id="txtCourseClass" name="txtCourseClass" value="<?php echo $_GET["txtCourseClass"]; ?>" hidden>
				<input type="text" id="txtCourseSubject" name="txtCourseSubject" value="<?php echo $_GET["txtCourseSubject"]; ?>" hidden>
				<input type="text" id="txtCourseID" name="txtCourseID" value="<?php echo $_GET["txtCourseID"]; ?>" hidden>
				<input type="text" id="txtStudentName" name="txtStudentName" value="<?php echo $_GET["childClassDropdown"]; ?>" hidden>

				<div id="videoembed"></div>
				<div id="divTutorial">
				
					<div class="container-fluid row" id="divQuestion">
						<p id="questionParagraph">Question 1. BLA BLA BLA BLA BLA BLA BLA. Answer below</p>
					</div>
					<div class="container-fluid row" id="divAnswer">
						<div id="divAnswerArea" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
					</div>
					<div class="container-fluid row" id="divAnswerOption">
						<div class="container-fluid row">
							<div id="divAnswer1" class="col-md-3">
								<p id="answer1" draggable="true" ondragstart="drag(event,'divAnswer1')">Answer 1</p>
							</div>
							<div id="divAnswer2" class="col-md-3">
								<p id="answer2" draggable="true" ondragstart="drag(event,'divAnswer2')">Answer 2</p>
							</div>
						</div>
						<div class="container-fluid row">
							<div class="col-md-3">
								<p id="answer3" draggable="true" ondragstart="drag(event)">Answer 3</p>
							</div>
							<div class="col-md-3">
								<p id="answer4" draggable="true" ondragstart="drag(event)">Answer 4</p>
							</div>
						</div>
					</div>
					<div><p id="confirmationText" style="color:green"></p></div>
					<div class="container-fluid row" id="divSubmit">
						<div class="col-md-3">
							<input type="button" id="btnSubmit" class="btn btn-primary" value="submit answer" onclick="submitTutorialAnswer()">
						</div>
						<div class="col-md-3">
							<input type="button" id="btnSubmit" value="submit questionnaire for correction" class="btn btn-success" onclick="questionnaireCorrectionFunction()">
						</div>
					</div>
					<!-- **************************************** Tutorial Stuff*************************************** -->
					<div id="divCompleteCourse" class="container"></div>
				</div>
			</div>
			<!--<img class="student" src="../img/student.png" alt="student" style="max-width:100%;height:auto;">-->
				<div class="col-sm-4">
					<center><h4>Table of Content</h4></center>
					<hr>
					<div id="divCourseContent"></div>				
				</div>
			</div> 
		</div>
		<footer class="container-fluid">
			<div class="copyright">
				<p>ekids © 2018 | All Rights Reserved</p>
			</div>
		</footer>
	</body>
</html>