<?php
$sid = $_POST["surveyid"] ;
include('dbcon.php');
$query = "SELECT * FROM `survey_answer_custom` WHERE survey_id = " . "'" . $sid . "'" ;
// echo $query ;
// $ts = array('saa' => "laa" );
// $ts.push("add" => "marja" ) ;
$result = $conn->query($query) ;
// $return = array() ;
$options = array() ;

while($row = $result->fetch_assoc()) {
  $options[] = $row ;
}
// $return['options'] = $options ;
echo json_encode($options) ;

// echo $opt[0] ;
?>
