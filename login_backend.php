<?php
session_start() ;

include 'dbcon.php' ;
$sid = $_POST['surveyid'] ;
$pass = $_POST['password'] ;
$_SESSION["surveyid"] = $sid ;
$qry = "SELECT * from survey WHERE survey_id='".$sid."'"." AND survey_password = '".$pass."'" ;
// echo $qry ;
$result = $conn->query($qry);
// echo $result ;
if($result->num_rows > 0)
{
	echo "valid" ;
}
?>
