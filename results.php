<?php
$sid = $_GET["surveyid"] ;
include("dbcon.php") ;

$query = "SELECT * FROM `survey_question` WHERE survey_id=". "'" . $sid . "'" ;
$result = $conn->query($query);
$send = array() ;
$question = array() ;
$options = array() ;
$response = array() ;
while($row = $result->fetch_assoc()) {
    // got the question and qid and  the type of the question
    $innerQuestion = array() ;
    $innerQuestion['question'] = $row["question"] ; // -------------------------------------  GOT THE QUESTION
    if($row["type"] == "1")
    {
      // it is mcq question therfore find the options
      $query2 = "SELECT * FROM `survey_answer_custom` WHERE qid = ". "'" . $row["qid"] . "'" ;
      $result2 = $conn->query($query2) ;
      // $options = "" ;
      while($row2 = $result2->fetch_assoc()){
        $innerQuestion['options'] = $row2["answer_option"] ;
      }
      //----------------------------------------------------------------------- got the options

      $query3 = "SELECT * FROM `survey_answer_type1` WHERE qid = ". "'" . $row["qid"] . "'" ;
      $result3 = $conn->query($query3);
      // $response = "" ;
      while($row3 = $result3->fetch_assoc()){
        $innerQuestion['response'] = $row3["response"] ;
      }
      // -------------------------------------------------------got the response of the questions

      array_push($question, json_encode($innerQuestion)) ;



    }  // end of the if statement of type 1
    else if($row['type'] == "3"){
      $opt = "Very Satisfied,Satisfied,Neutral,Somewhat Satisfied,Not at all Satisfied" ;
      // got the options
      $innerQuestion3 = array() ;
      $innerQuestion3['question'] = $row['question'] ;
      $innerQuestion3['options'] = $opt ;

      $query3 = "SELECT * FROM `survey_answer_type3` WHERE qid = ". "'" . $row["qid"] . "'" ;
      $result3 = $conn->query($query3);
      // $response = "" ;
      while($row3 = $result3->fetch_assoc()){
        $innerQuestion3['response'] = $row3["response"] ;
      }

      array_push($question, json_encode($innerQuestion3)) ;

    } // end of if statement of type 3
    else if($row['type'] == '4'){
      $opt = "custom option 1,custom option 2,custom option 3,custom option 4,custom option 5" ;
      $innerQuestion4 = array() ;
      $innerQuestion4['question'] = $row['question'] ;
      $innerQuestion4['options'] = $opt ;

      $query3 = "SELECT * FROM `survey_answer_type4` WHERE qid = ". "'" . $row["qid"] . "'" ;
      $result3 = $conn->query($query3);
      // $response = "" ;
      while($row3 = $result3->fetch_assoc()){
        $innerQuestion4['response'] = $row3["response"] ;
      }

      array_push($question, json_encode($innerQuestion4)) ;


    }




}
$send['question'] = ($question) ;
// $send['options'] = ($options) ;
// $send['response'] = ($response) ;

$st = json_encode($send) ;
echo json_encode($send) ;

 ?>

 <html>
 <head>
   <script type="text/javascript">
      $('document').ready(function(){
        var test = <?php echo $st ?> ;
        
        console.log(test) ;

      })
   </script>
   <body>

   </body>
 </head>
 </html>
