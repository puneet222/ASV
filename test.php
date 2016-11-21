<?php

include('dbcon.php') ;
// echo "fnrfn" ;
$query = "SELECT `qid`, `type`, `question` FROM `common_question` WHERE type="."'type1'" ;
echo $query ;
$result = $conn->query($query);
// echo $result;
$rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
$question = json_encode($rows) ;
echo $question ;
?>
