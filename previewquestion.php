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

  $query = "SELECT * FROM `survey_answer_custom` WHERE survey_id = "."'".$sid."'" ;
  $res = $conn->query($query) ;
  // $row = $res->fetch_assoc() ;
  $rows2 = array();
  while($r=$res->fetch_assoc())
  {
  $rows2[]=$r;
  }

  echo json_encode($rows);
  echo "-{]&%this_is_split$#%[{-" ;
  echo json_encode($rows2) ;
 ?>
