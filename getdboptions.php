<?php
include('dbcon.php') ;
$sendarray = array() ;
$temp = array() ;
$query2 = "SELECT * FROM `common_question_answer` " ;
echo $query2 ;
$result = $conn->query($query2) ;
// echo $result ;
while($row = $result->fetch_accoc()){
  echo $row['qid'];
  $temp['qid'] = $row['qid'] ;
  $temp['answer'] =$row['answer'] ;
  $sendarray[] = $temp ;
}
echo json_encode($sendarray) ;

 ?>
