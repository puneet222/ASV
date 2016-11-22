<?php
$sid = $_POST["surveyid"] ;
// $sid = $_GET["sur"] ;
include('dbcon.php');
$query = "SELECT * FROM `survey_answer_custom` WHERE survey_id = " . "'" . $sid . "'" ;
$result = $conn->query($query) ;
// $return = array() ;
$options = array() ;

while($row = $result->fetch_assoc()) {
  $options[] = $row ;
  $qid = $row["qid"] ;
  $ans = $row["answer_option"] ;
  $opt = explode(",", $ans) ;
  $len = count($opt) ;
  $str = "" ;
  for ($i=0; $i < $len-1; $i++) {
    $str = $str."0," ;
  }
  $str = $str."0" ;

  // now we have the question id and survey id and intializing string

  $query = "INSERT INTO `survey_answer_type1`(`qid`, `survey_id`, `response`) VALUES (?,?,?)" ;
  $stmt = $conn->prepare($query) ;
  $stmt->bind_param('sss', $qid , $sid , $str);

  $stmt->execute() ;

}
$return['options'] = $options ;
echo json_encode($options) ;


// -----------------------  INITIALIZING THE QUESTION TABLE --------------------------------

?>
