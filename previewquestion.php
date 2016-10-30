<?php
  session_start() ;
  $sid = $_SESSION['surveyid'] ;
  include("dbcon.php") ;
  $query = "SELECT * FROM `survey_question` WHERE survey_id = "."'".$sid."'" ;
  // echo $query ;
  $res = $conn->query($query) ;
  // $row = $res->fetch_assoc() ;
  $rows = array();
  while($r=$res->fetch_assoc())
  {
  $rows[]=$r;
  }
  echo json_encode($rows);
 ?>
