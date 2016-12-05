<?php
$options = $_POST['options'] ;
include('dbcon.php') ;

$length = $_POST['optionlength'] ;
$qid = $_POST['questionid'] ;

$query = 'UPDATE `survey_answer_custom` SET `answer_option`= "'.$options.'" WHERE qid = "' . $qid . '"' ;
mysqli_query($conn , $query) ;

$len = (int)$length ;
$init = "" ;
for($i=0 ; $i < $len-1 ; $i++){
  $init = $init."0," ;
}
$init = $init."0" ;

$query = 'UPDATE `survey_answer_type1` SET `response`= "'.$init.'" WHERE qid = "' . $qid . '"' ;
mysqli_query($conn , $query) ;
?>
