<?php
$sid = $_GET["surveyid"] ;
include("dbcon.php") ;

$query = "SELECT * FROM `survey_question` WHERE survey_id=". "'" . $sid . "'" ;
$result = $conn->query($query);
while($row = $result->fetch_assoc()) {
    // got the question and qid and  the type of the question
    $question = $row["question"] ; // -------------------------------------  GOT THE QUESTION
    if($row["type"] == "1")
    {
      // it is mcq question therfore find the options
      $query2 = "SELECT * FROM `survey_answer_custom` WHERE qid = ". "'" . $row["qid"] . "'" ;
      $result2 = $conn->query($query2) ;
      $options = "" ;
      while($row2 = $result2->fetch_assoc()){
        $options = $row2["answer_option"] ;
      }
      //----------------------------------------------------------------------- got the options

      $query3 = "SELECT * FROM `survey_answer_type1` WHERE qid = ". "'" . $row["qid"] . "'" ;
      $result3 = $conn->query($query3);
      $response = "" ;
      while($row3 = $result3->fetch_assoc()){
        $response = $row3["response"] ;
      }
      // -------------------------------------------------------got the response of the questions

      echo "question : ".$question ;
      echo "Options : ".$options ;
      echo "response : ".$response ;
      echo "\n\n" ;

    }
}
 ?>
