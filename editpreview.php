<?php
session_start() ;
$sid = $_SESSION['surveyid'] ;
echo "fuucking".$sid ;
include("dbcon.php") ;
$qid = $_POST['qid'] ;
$question = $_POST['question'] ;
echo $question ;
echo $qid ;
echo "fucking dillu " ;
$query = "UPDATE `survey_question` SET `question`= '".$question."' WHERE survey_id= '".$sid."' AND qid = '".$qid."';";

echo $query ;

mysqli_query($conn , $query) ;
?>
