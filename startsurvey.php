<?php
include('dbcon.php') ;
session_start() ;
$sid = $_SESSION['surveyid'] ;
$query = 'UPDATE `survey` SET `start`= 1 WHERE survey_id="'.$sid.'"' ;
mysqli_query($conn , $query) ;
?>
