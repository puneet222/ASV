<?php
include("dbcon.php");
$sid = $_POST["surveyid"] ;
$email = $_POST["email"] ;
if($email == "not_authorized"){
  // no need to get the mail as the survey is open
}
else{
  $query = 'UPDATE `auth_table` SET `filled`=1 WHERE survey_id="'.$sid.'"'.' AND email_id="'.$email.'"' ;
  mysqli_query($conn , $query);
}
$data = $_POST["str"] ;
$inputqa = $_POST['answerquestion'] ;
echo $data."--------- in php" ;
$ques = explode(",", $data) ;

for ($i=0; $i < count($ques); $i++) {
  $arr = explode("-", $ques[$i]) ;
  if($arr[1] == "1")
  {
    // type 1 mcq questions
    $query = "SELECT * FROM `survey_answer_type1` WHERE qid = "."'". $arr[0] . "'" ;
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        $ans = $row["response"] ;
        $opt = explode(",", $ans);
        $temp = $opt[$arr[2]] ;
        $temp++ ;
        $opt[$arr[2]] = $temp;
        $opt = implode(",", $opt) ;
        echo $opt ;
        echo "\n";
        $query = "UPDATE `survey_answer_type1` SET `response`=". "'" . $opt . "'" ." WHERE qid = "."'". $arr[0] . "'" ;
        mysqli_query($conn , $query) ;
    }
  }
  else if($arr[1] == "3")
  {
    // type 3 questions
    $query = "SELECT * FROM `survey_answer_type3` WHERE qid = "."'". $arr[0] . "'" ;
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        $ans = $row["response"] ;
        $opt = explode(",", $ans);
        $temp = $opt[$arr[2]] ;
        $temp++ ;
        $opt[$arr[2]] = $temp;
        $opt = implode(",", $opt) ;
        echo $opt ;
        echo "\n";
        $query = "UPDATE `survey_answer_type3` SET `response`=". "'" . $opt . "'" ." WHERE qid = "."'". $arr[0] . "'" ;
        mysqli_query($conn , $query) ;
    }
  }
  else if($arr[1] == "4"){
    $query = "SELECT * FROM `survey_answer_type4` WHERE qid = "."'". $arr[0] . "'" ;
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        $ans = $row["response"] ;
        $opt = explode(",", $ans);
        $temp = $opt[$arr[2]] ;
        $temp++ ;
        $opt[$arr[2]] = $temp;
        $opt = implode(",", $opt) ;
        echo $opt ;
        echo "\n";
        $query = "UPDATE `survey_answer_type4` SET `response`=". "'" . $opt . "'" ." WHERE qid = "."'". $arr[0] . "'" ;
        mysqli_query($conn , $query) ;
    }
  }
}
echo $inputqa ;
$total = explode("-[;'per]'0)", $inputqa) ;
for($i = 0 ; $i < sizeof($total) ; $i++){
  $inner = explode(")}_|-[{", $total[$i]) ;
    echo "question id --------> ".$inner[0] ;
    echo "answer  ------->  ".$inner[1] ;
  $query = "INSERT INTO `survey_answer_type2`(`qid`, `answer`) VALUES (?,?)" ;
  echo $query ;
  $stmt = $conn->prepare($query) ;
  $stmt->bind_param('ss', $inner[0] , $inner[1]);
  $stmt->execute();
  $stmt->close();
}

?>
