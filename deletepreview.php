<?php
session_start() ;
$sid = $_SESSION['surveyid'] ;
echo "fuucking".$sid ;
include("dbcon.php") ;
$qid = $_POST['qid'] ;
echo $qid ;
echo "fucking dillu " ;
$query = "DELETE FROM `survey_question` WHERE survey_id = '".$sid."' AND qid = '".$qid."';";

echo $query ;

mysqli_query($conn , $query) ;
?>
