<?php
$qid = $_POST["qid"] ;
$sid = $_POST["surveyid"] ;
$response = $_POST["response"] ;

echo $sid ;
echo $qid ;
echo $response ;
include("dbcon.php") ;
$query = "INSERT INTO `survey_answer_type1`(`qid`, `survey_id`, `response`) VALUES (?,?,?)" ;
$stmt = $conn->prepare($query) ;
$stmt->bind_param('sss', $qid , $sid , $response);

$stmt->execute() ;

?>
