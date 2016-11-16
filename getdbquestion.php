<?php

include('dbcon.php') ;
$type = $_POST['type'] ;
// $type = 1 ;
// echo $type ;
$query = "SELECT `qid`, `type`, `question` FROM `common_question` WHERE type=".$type ;
 // echo $query ;
$result = $conn->query($query);
// // echo $result;
$rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

$question = json_encode($rows) ;
// return $question ;
echo $question ;
?>
