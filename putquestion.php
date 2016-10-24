<?php
session_start() ;
$data = $_POST['question'] ;
$option = $_POST['option'] ;
echo "below are the options--------------------------------------------" ;
echo $option ;
// echo $data ;
$arr = explode("," , $data) ;
$question = $arr[0] ;
$type = $arr[1] ;
$sid = $_SESSION['surveyid'] ;

include("dbcon.php") ;
// get making the id of the question

$res = $conn->query("Select * from ids") ;
$row = $res->fetch_assoc();
// echo $row['question'];
$numq = $row['question'];
$numq = $numq + 1 ;
$numa = $row['survey'] ;
$nume = $row['extra'] ;

// now truncate the Table
$trunk = "TRUNCATE TABLE ids" ;
mysqli_query($conn, $trunk);

$stmt = $conn->prepare("INSERT INTO `ids`(`question`, `survey`, `extra`) VALUES (?, ?, ?)");
$stmt->bind_param('ddd', $numq , $numa , $nume);

/* execute prepared statement */
$stmt->execute();

$id = "" ;

echo "type : ".$type ;

if($type == '1')
  {
    $id = "mcq".$numq ;
  }
else if($type == '2')
  {
    // input
    $id = "input".$numq ;
  }
else if($type == '3')
  {
    // ranking
    $id = "rank".$numq ;
  }
else {
  // custom
  $id = "cust".$numq ;
}

// got the id

$query = "INSERT INTO `survey_question`(`qid`, `survey_id`, `question`, `type`) VALUES (?,?,?,?)" ;

echo "question id : ".$id." Question : ".$question ;

$stmt = $conn->prepare($query) ;
$stmt->bind_param('sssd' , $id , $sid , $question , $type) ; // bind the parameters

$stmt->execute() ;

?>
