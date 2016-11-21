<?php
$sid = $_POST['surveyid'] ;
include("dbcon.php") ;
$data = array() ;
$query = "SELECT * FROM `survey_question` WHERE survey_id =". "'" . $sid . "'";
// echo $query ;
$result = $conn->query($query);
while($row = $result->fetch_assoc()) {
    $data[] = $row ;
}
$questions = json_encode($data) ;
echo $questions ;
?>
