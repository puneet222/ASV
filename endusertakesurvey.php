<?php
include('dbcon.php') ;
$surveyid = $_GET['surveyid'] ;
// check whether the survey is authorized or Not
$query = "SELECT * FROM `survey` WHERE survey_id =". "'" . $surveyid . "'" ;
$result = $conn ->query($query) ;
$row = $result->fetch_assoc() ;
$auth = $row['auth'] ;

// -- function for redirect
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

if($auth == 1)
{
  echo "Authorized" ;
  // redirect to surveylogin.php
  Redirect("surveylogin.php?surveyid=".$surveyid) ;
}
else{
  echo "Unauthorized" ;
  Redirect("survey.php?surveyid=".$surveyid);
}
?>
