<?php
$surveyid = $_GET['surveyid'] ;
include("dbcon.php") ;
session_start() ;
$qid = $_POST['qid'] ;
// echo $qid ;
$arr = explode("," , $qid) ;
$size = sizeof($arr) ;
for($i = 0 ; $i < $size-1 ; $i++)
{

  echo $arr[$i] ;
  //select query  for getting the question that user has selected
  $q = $arr[$i] ;

  $query = "SELECT `qid`, `type`, `question` FROM `common_question` WHERE `qid`="."'".$q."'";
  echo $query ;
  $result = $conn ->query($query) ;
  $row = $result->fetch_assoc() ;
  $type = $row['type'] ;
  // $type = (int)$tarr[4];
  $question =  $row['question'] ;
  $sid = $surveyid ;

  // insert the selected question ;
  $stmt = $conn->prepare("INSERT INTO `survey_question`(`qid`, `survey_id`, `question`, `type`) VALUES (?,?,?,?)") ;
  $stmt->bind_param('sssd', $q , $sid , $question , $type);
  $stmt->execute();
  $stmt->close();
  echo $query ;

  $test = "using session variables : ".$_SESSION["surveyid"] ;
  echo $test;
}
 ?>
