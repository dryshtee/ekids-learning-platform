<?php
session_start();

// $userID=$_SESSION["userFullName"];
// $courseSubject="french";
// $courseClass="grade4";

$courseSubject=$_GET["courseSubject"];
$courseClass=$_GET["courseClass"];
$courseID=$_GET["courseID"];


$conn=mysqli_connect("localhost","root","","e_kids");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
	$retrieveQuery="SELECT c.courseID,q.questionID,q.questionNumber
					,q.assessmentQuestion,q.chapterTitle,q.videoURL,q.answersOptionID
					,a.answersOptionID,a.optionA,a.optionB,a.optionC,a.optionD,a.correctAnswer
					FROM tbl_course c LEFT JOIN tbl_question q
					ON c.courseID=q.courseID
					LEFT JOIN tbl_answers a
					ON q.answersOptionID=a.answersOptionID
					WHERE c.courseSubject=? AND c.courseClass=? AND c.courseID=?
					ORDER BY q.questionNumber ASC
					";
	$stmt1=$conn ->prepare($retrieveQuery);

	$stmt1->bind_param("sss",$courseSubject,$courseClass,$courseID);

	$stmt1 ->bind_result($courseID_Col,$questionID_Col,$questionNumber_Col,$assessmentQuestion_Col,$chapterTitle_Col,$videoURL_Col,$answerOptionID_Col,$answersOptionID_tblAns_Col,$optionA_Col,$optionB_Col,$optionC_Col,$optionD_Col,$correctAnswer_Col);
	
	
	$stmt1 ->execute();
	
	//resource for creating json in php: https://stackoverflow.com/questions/6281963/how-to-build-a-json-array-from-mysql-database
	
	$return_arr = array();
	
	while ($stmt1 ->fetch()) {
		$row_array['chapterTitle'] = $chapterTitle_Col;
		$row_array['url'] =$videoURL_Col;
		$row_array['question'] = $assessmentQuestion_Col;
		$row_array['optionA'] =$optionA_Col;
		$row_array['optionB'] =$optionB_Col;
		$row_array['optionC'] =$optionC_Col;
		$row_array['optionD'] =$optionD_Col;
		$row_array['correctAnswer'] =$correctAnswer_Col;
		//$row_array['col1'] = $row['col1'];
		//$row_array['col2'] = $row['col2'];
		array_push($return_arr,$row_array);
	}

	echo json_encode($return_arr);

/*$json_array = array(

//Each array below must be pulled from database
    //1st record
    array(
    'id' => 111,
    'title' => "Event1",
    'start' => "$year-$month-10",
    'url' => stripslashes("http://yahoo.com/")
),

     //2nd record
     array(
    'id' => 222,
    'title' => "Event2",
    'start' => "$year-$month-20",
    'end' => "$year-$month-22",
    'url' => "http://yahoo.com/"
)


);*/

//echo json_encode($json_array);
}
?>