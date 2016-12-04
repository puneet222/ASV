<?php
$surveyid = $_GET['surveyid'] ;
include("dbcon.php") ;
session_start() ;
$qid = $_POST['qid'] ;
// echo $qid ;
$arr = explode("," , $qid) ;

$size = sizeof($arr) ;


for($i = 0 ; $i < $size-1 ; $i++)
{

  // -- geting the latest number of id for making new question id ----
  $res = $conn->query("Select * from ids") ;
  $row2 = $res->fetch_assoc();
  echo $row2['question'];
  $numq = $row2['question'];
  $numq = $numq + 1 ;
  $numa = $row2['survey'] ; // saved for inserting again
  $nume = $row2['extra'] ; // saved for inserting again
  // -- -- numq has the new latest number   ---

  echo $arr[$i] ;
  //select query  for getting the question that user has selected via questoin id "q"
  $q = $arr[$i] ;

  // check whether the question exists in the database or No
  $query = "SELECT * FROM `redunt_check` WHERE `survey_id`="."'".$surveyid."'"." AND `common_qid`="."'".$q."'" ;
  $result = $conn ->query($query) ;
  $row = $result->fetch_assoc() ;
  echo "\nthis will be our qid check\n" ;
  $test =  $row['common_qid'] ;
  if($test){
    // question exists
    echo "exist" ;
  }
  else{
    // input question and update the redunt table

    // updating the redunt table
    $query = "INSERT INTO `redunt_check`(`survey_id`, `common_qid`) VALUES (?,?)" ;
    $stmt = $conn->prepare($query) ;
    $stmt->bind_param('ss', $surveyid , $q);
    $stmt->execute();
    $stmt->close();
    echo "ont" ;
    $query = "SELECT `qid`, `type`, `question` FROM `common_question` WHERE `qid`="."'".$q."'";
    echo $query ;
    $result = $conn ->query($query) ;
    $row = $result->fetch_assoc() ;
    $type = $row['type'] ;
    // $type = (int)$tarr[4];
    $question =  $row['question'] ;
    $sid = $surveyid ;

    // query for getting the questions from the table via question id "q"
    $query = "SELECT `qid`, `answer` FROM `common_question_answer` WHERE `qid`="."'".$q."'" ;
    $result = $conn ->query($query) ;
    $row = $result->fetch_assoc() ;
    $option = $row['answer'] ;
    echo $option ;


    // insert the selected question with updated question id ;
    $arr2 = explode("-" , $q) ;
    // arr2 hast first entry question type like "mcq" , "input" , etc ;
    $q = $arr2[0].$numq ; // this is updated question id
    echo "updated question id  : ".$q;
    $stmt = $conn->prepare("INSERT INTO `survey_question`(`qid`, `survey_id`, `question`, `type`) VALUES (?,?,?,?)") ;
    $stmt->bind_param('sssd', $q , $sid , $question , $type);
    $stmt->execute();
    $stmt->close();
    echo "question table updated\n";

    // entering the options
    $stmt = $conn->prepare("INSERT INTO `survey_answer_custom`(`qid`, `answer_option`, `survey_id`) VALUES (?,?,?)") ;
    $stmt->bind_param('sss', $q , $option , $sid);
    $stmt->execute();
    $stmt->close();
    echo "\nanswer table updatded";

    // making the init string for initializing table
    $oarr = explode(",", $option) ;
    $olen = sizeof($oarr) ;
    $init = "" ;
    for($j = 0 ; $j < $olen-1 ; $j++)
    {
      $init = $init."0," ;
    }
    $init = $init."0" ;
    echo "\n this is the init string : ".$init;

    // getting initialized table ----------------------------------------------

    $stmt = $conn->prepare("INSERT INTO `survey_answer_type1`(`qid`, `survey_id`, `response`) VALUES (?,?,?)") ;
    $stmt->bind_param('sss', $q , $sid , $init);
    $stmt->execute();
    $stmt->close();

    // changes to be made in id table
    $trunk = "TRUNCATE TABLE ids" ;
    mysqli_query($conn, $trunk);

    $stmt = $conn->prepare("INSERT INTO `ids`(`question`, `survey`, `extra`) VALUES (?, ?, ?)");
    $stmt->bind_param('ddd', $numq , $numa , $nume);

    /* execute prepared statement */
    $stmt->execute();
  }




}
 ?>
