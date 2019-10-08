<?php
	//resource: https://www.dyn-web.com/tutorials/php-js/json/decode.php
	session_start();
	header('Content-Type: application/json');
	//echo "here i am";
	//echo "I received: ".$_POST['titleArray'];
	$theArray = json_encode($_POST['titleArray']);
	//echo $theArray;
	
	//getting data that are not from JSON array 
	$courseSubject=$_POST["courseSubject"];
	$courseClass=$_POST["courseClass"];
	$numberOfQuestion=$_POST["numberOfQuestion"];
	$courseID=$courseClass.rand(10,100);
	//echo "<br/>";
	//echo $_POST["numberOfQuestion"];
	
/*$json = '[
    {
        "title": "Professional JavaScript",
        "author": "Nicholas C. Zakas"
    },
    {
        "title": "JavaScript: The Definitive Guide",
        "author": "David Flanagan"
    },
    {
        "title": "High Performance JavaScript",
        "author": "Nicholas C. Zakas"
    }
]';

$books = json_decode($json);
// access property of object in array
echo $books[2]->title; // JavaScript: The Definitive Guide */

$questionID="QU".$courseClass.$courseSubject.rand(1,100);
$answerID="AN".$courseClass.$courseSubject.rand(1,100);



$books = json_decode($_POST['titleArray']);
// access property of object in array
/*echo $books[2]->title;
echo "<br/>";
echo $books[2]->URL;*/

$conn=mysqli_connect("localhost","root","","e_kids");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
	//insert in tbl_course
	$insertCourseQuery="INSERT INTO tbl_course(courseID, creatorID, courseSubject, courseClass, courseNumberOfQuestion) VALUES (?,?,?,?,?)";
	$insertCourseStmt=$conn ->prepare($insertCourseQuery);
	$insertCourseStmt->bind_param("ssssi",$courseID,$_SESSION["userID"],$courseSubject,$courseClass,$numberOfQuestion);
	$insertCourseStmt->execute();
	$insertCourseStmt->close();

}

for($i=0;$i<$numberOfQuestion;$i++){
		$questionID="QU".$courseClass.$courseSubject.rand(1,100);
		$answerID="AN".$courseClass.$courseSubject.rand(1,100);
		
		$insertQuestionQuery="INSERT INTO tbl_question(courseID, questionID, questionNumber, assessmentQuestion, chapterTitle, videoURL, answersOptionID) VALUE (?, ?, ?, ?, ?, ?, ?)";
		$insertQuestionStmt=$conn ->prepare($insertQuestionQuery);
		$insertQuestionStmt->bind_param("ssissss",$courseID,$questionID,$i,$books[$i]->question,$books[$i]->title,$books[$i]->URL,$answerID);
		$insertQuestionStmt->execute();
		$insertQuestionStmt->close();
		
		$insertAnswerQuery="INSERT INTO tbl_answers(answersOptionID, optionA, optionB, optionC, optionD, correctAnswer) VALUES (?, ?, ?, ?, ?, ?)";
		$insertAnswerStmt=$conn->prepare($insertAnswerQuery);
		$insertAnswerStmt->bind_param("ssssss",$answerID,$books[$i]->optionA,$books[$i]->optionB,$books[$i]->optionC,$books[$i]->optionD,$books[$i]->correctAnswer);
		$insertAnswerStmt->execute();
		$insertAnswerStmt->close();
}

	/*$theArrayDecode=json_decode($theArray,true);
	echo $theArrayDecode;
	//$json_array  = json_decode($json_string, true);
	$elementCount  = count($theArrayDecode);
	echo "<br/>";
	//echo $elementCount;
	echo "<br/>";
	//print $theArrayDecode[2].["title"];
	echo($theArrayDecode[2]["title"]);*/
?>