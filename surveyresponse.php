<?php
$sid = $_GET["surveyid"] ;
include('dbcon.php') ;

$query = "SELECT  `auth` FROM  `survey`  WHERE auth = 1 AND survey_id = " . "'" .$sid. "'".  ";" ;
echo $query ;
$result = $conn->query($query);

$auth = 0 ;

while($row = $result->fetch_assoc()) {
    $auth = $row['auth'] ;
}

if($auth == 1)
{
  // display login page
  $redirect = "surveylogin.php?surveyid=".$sid ;
  echo $redirect ;
  header("Location: ".$redirect) ;
}
else {
  // display the survey page
}

?>
