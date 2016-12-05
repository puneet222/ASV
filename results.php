<?php
$sid = $_GET["surveyid"] ;
include("dbcon.php") ;

// getting the heading of the survey
$query = 'SELECT * FROM `survey` WHERE survey_id='.'"'.$sid.'"' ;
$result = $conn->query($query);
$data = $result->fetch_assoc() ;
$head = $data['survey_heading'] ;
// echo $head;

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
$send = ($question) ;
// $send['options'] = ($options) ;
// $send['response'] = ($response) ;

$st = json_encode($send) ;
// echo json_encode($send) ;

 ?>

 <!DOCTYPE html>

 <html lang="en">
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Survey Results</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css2/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css2/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="css2/style.css" rel="stylesheet">
    <!-- JQuery -->
       <script type="text/javascript" src="js2/jquery-3.1.1.min.js"></script>

       <!-- Bootstrap tooltips -->
       <script type="text/javascript" src="js2/tether.min.js"></script>

       <!-- Bootstrap core JavaScript -->
       <script type="text/javascript" src="js2/bootstrap.min.js"></script>

       <!-- MDB core JavaScript -->
       <script type="text/javascript" src="js2/mdb.min.js"></script>
 <head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
       <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
   <script type="text/javascript">
      $('document').ready(function(){
        $("#content").html("") ;
        var clr = ["#CB4335" , "#CA6F1E" , "#D4AC0D" , "#566573" , "#3498DB"] ;
        var hlght = ["#E74C3C" , "#E67E22" , "#F8C471" , "#808B96" , "#85C1E9"] ;
        var test = <?php echo $st ?> ;
        var len = test.length ;
        console.log(test) ;
        // for(var i = 0 ; i < len ; i++)
        // {
        //   $("#content").append("<canvas id='myChart"+i+"'"+"></canvas>") ;
        // }
        for(var i = 0 ; i < len ; i++)
        {

          var arr = test[i].split('"') ;
          var question_proto = arr[3] ;
          var options_proto = arr[7] ;
          var response_proto = arr[11] ;

          console.log(options_proto);
          console.log(question_proto);
          console.log(response_proto);

          var options = options_proto.split(",") ;
          var response = response_proto.split(",") ;

          var html = '<div class="text-md-center"><h4>'+question_proto+'</h4></div><div class="row"><div class="col-md-6">' + "<canvas id='myChart"+i+"'"+"></canvas></div>" + '<div id="options" class="col-md-6"><br></div>' ;

          // $("#content").append('<div class="text-md-center"><h4>'+question_proto+'</h4></div><div class="row"><div class="col-md-6">') ;
          // $("#content").append("<canvas id='myChart"+i+"'"+"></canvas></div>") ;
          // $("#content").append('<div id="options" class="col-md-6"><br><br></div></div>');

          // $("#content").append(html) ;

          var ilen = response.length ;
          var data = [] ;
          var str = "" ;
          for(var j = 0 ; j < ilen ; j++)
          {
            var pstr = {value : response[j] , color : clr[j] , highlight : hlght[j] , label : options[j]} ;
            data.push(pstr) ;
            str += '<h5 style="color:' + clr[j] + '"><i class="fa fa-circle" aria-hidden="true"></i>' +  options[j] +  '</h5>' ;
            // $("#content").append('<h5 style="color:' + clr[j] + '"><i class="fa fa-circle" aria-hidden="true"></i>' +  options[j] +  '</h5>')
          }

          var string = html + str + "</div>" ;

          $("#content").append(string) ;

          console.log(data);
          var option = {
          responsive: true,
          };

          // Get the context of the canvas element we want to select
          var ctx = document.getElementById("myChart"+i).getContext('2d');
          var myDoughnutChart = new Chart(ctx).Doughnut(data,option);

        }

        var da = [{value : 3  , color : "black" , highlight : "yellow" , label : "puneet"}] ;
        var option = {
        responsive: true,
        };
        var ctx = document.getElementById("puneet").getContext('2d');
        var myDoughnutChart = new Chart(ctx).Doughnut(da,option);


      })
   </script>

 </head>


    <body>
      <div class="container">
        <div class="row">
          <div class="col-md-8 center" style="position:relative;top:20px;left:150px;">
            <h2 class="text-center font-weight-normal"><?php echo $head ?> Survey Results</h2>
          </div>
          <div class="col-md-4 center">
            <button type="button" class="btn btn-amber" style="position:fixed">Profile</button>
          </div>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </div>
        <div id="content">

        </div>


<!--
        <div class="text-md-center">
          <h4>This is the question </h4>
        </div>
        <div class="row">
          <div class="col-md-6">
            <br>
              <canvas id="puneet"></canvas>
          </div>
          <div id="options" class="col-md-6">
            <br><br />
            <h5 style="color:red"><i class="fa fa-circle" aria-hidden="true"></i>  option1</h5>
            <h5 style="color:red"><i class="fa fa-circle" aria-hidden="true"></i>  option2</h5>
            <h5 style="color:red"><i class="fa fa-circle" aria-hidden="true"></i>  option3</h5>
            <h5 style="color:red"><i class="fa fa-circle" aria-hidden="true"></i>  option4</h5>
            <h5 style="color:red"><i class="fa fa-circle" aria-hidden="true"></i>  option5</h5>
          </div>

        </div> -->
      </div>
    </body>
 </html>
