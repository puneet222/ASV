<?php
include 'dbcon.php' ;
$sid = $_POST['surveyid'] ;
$pass = $_POST['password'] ;
$qry = "SELECT * from survey WHERE survey_id='".$sid."'"." AND survey_password = '".$pass."'" ;
// echo $qry ;
$result = $conn->query($qry);
// echo $result ;
if($result->num_rows > 0)
{
	echo "valid" ;
}
?>