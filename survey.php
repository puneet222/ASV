<?php
$sid = $_GET['surveyid'] ;
include("dbcon.php") ;
// getting the heading of the survey
$query = 'SELECT * FROM `survey` WHERE survey_id='.'"'.$sid.'"' ;
$result = $conn->query($query);
$data = $result->fetch_assoc() ;
$head = $data['survey_heading'] ;


$query = "SELECT * FROM `survey` WHERE survey_id =". "'" . $sid . "'" ;
$result = $conn ->query($query) ;
$row = $result->fetch_assoc() ;
$auth = $row['auth'] ;
$start = $row['start'] ;
// echo $start ;
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

if($start == 0)
{
	// survey not started yet
	Redirect("notstart.html") ;
}
if($start == 2){
  Redirect("stopsurvey.html");
}

// check the auth in order to check whether to take the email or Not
if($auth == 1){
$email = $_GET['email'] ;
// echo $email ;
}
else{
	$email = "not_authorized" ;
	// echo "not authorized" ;
}
$query = "SELECT * FROM `auth_table` WHERE survey_id =". "'" . $sid . "'"." AND email_id='".$email."'" ;
// echo $query ;
$result = $conn ->query($query) ;
$filled = 0 ;
while($row = $result->fetch_assoc()){
  $filled = $row['filled'] ;
}


if($filled == 1){
	Redirect("alreadyfilled.html");
}



?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  </head>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#head-survey").html("<h3 class='header'><?php echo $head ?>  Survey </h3>" )
    $("#question").html("") ;
    $("#options").html("");

    $('.myForm input').on('change', function() {
    console.log($('input[name=group1]:checked', '.myForm').val());
    });



    function getOptions(qid , options)
    {
      for(var i = 0 ; i < options.length ; i++)
      {
        if(qid == options[i]["qid"])
        {
          return options[i] ;
        }
      }
    }

    var sendobj = {} ;
    sendobj["test"] = "1" ;
    sendobj["test1"] = "12" ;
    sendobj["test2"] = "13" ;

    console.log(sendobj) ;

    $("#bt").click(function(){
      $.ajax({
        type : "POST",
        url : "getsurveyquestions.php",
        data : "surveyid=<?php echo $sid ?>" ,
        cache : false,
        success : function(result){
          result = JSON.parse(result) ;
          console.log(result) ;
          var len = result.length ;
					console.log("\nlength is : " + len);
          sendobj = "" ;
          var sendanswer = "" ;
          var mflag = 1 ;
          var iflag = 1 ;
          for(var i = 0 ; i < len ; i++)
          {
            // console.log($('input[name='+ result[i]["qid"] +']:checked').val()) ;
            if(result[i]["type"] == "1" || result[i]["type"] == "4" || result[i]["type"] == "3")
            {

              if(!$('input[name='+ result[i]["qid"] +']:checked').val()){
								$("#div1"+result[i]["qid"]).addClass("red") ;
                mflag = 0 ;
							}
							else{
								sendobj += $('input[name='+ result[i]["qid"] +']:checked').val() + ",";
							}
            }
            else{
              // handle input questions
              if($("#input-"+result[i]['qid']).val() == ""){
                // null string then skip
              }
              else{
                  sendanswer += result[i]['qid']+")}_|-[{"+$("#input-"+result[i]['qid']).val() + " -[;'per]'0)" ;
              }

            }
          }
          console.log("------------------------------------------------------------------------------------") ;
          console.log(sendanswer) ;
          sendobj = sendobj.slice(0,sendobj.length-1);
          sendanswer = sendanswer.slice(0,sendanswer.length-12) ;
          console.log("----------"  + sendanswer) ;
          console.log(sendobj) ;
          // send this to another page to update the database
          if(mflag == 1 && iflag == 1){
            $.ajax({
              type : "POST" ,
              url : "submitresponse.php",
              data : "str=" + sendobj + "&surveyid=" + "<?php echo $sid ?>" + "&email=" + "<?php echo $email ?>" + "&answerquestion=" + sendanswer ,
              cache : false,
              success : function(response){
                console.log(response) ;
                window.location.href = "aftersubmit.html" ;
  							// -- ---------------------Redirecting to another page after filling the survey -----------
  							// window.location.href = "aftersurveyresponse.php" ;
              }
            })

          } // end if
          else{
            alert("please fill all the questions") ;
          }
        }
      }) ;
    })



    $.ajax({
      type : "POST",
      url : "getsurveyquestions.php",
      data : "surveyid=<?php echo $sid ?>" ,
      cache : false,
      success : function(result){
        result = JSON.parse(result) ;
        console.log(result) ;

        // get the questions of the survey and now getting the options
        var len = result.length ;


        $.ajax({
          type : "POST",
          url : "getoptions.php",
          data : "surveyid=<?php echo $sid ?>" ,
          cache : false,
          success : function(options){
            options = JSON.parse(options) ;
            console.log(options) ;
            console.log(result);

            // having all the questions and options of mcq questions

            for (var i = 0; i < len; i++) {
              // c  onsole.log("type : " + result[i]["type"]) ;
              if(result[i]["type"] == "1")
              {
                console.log("mcq") ;
								console.log("question is : " + result[i]["qid"]);
                var optdata = getOptions(result[i]["qid"] , options) ;
								console.log("\n\n\n\noptions data is -------------\n\n\n");
                console.log(optdata) ;
                // got the mcq questions and the option of that questions
                $("#options").append("<h4 class='header'>" + result[i]['question'] + "</h4>") ;

                var opt = optdata["answer_option"] ;
                var optarr = opt.split(",") ;
                var olen = optarr.length ;
                console.log(optarr) ;
                console.log("option array length : " + olen)
                for(var j = 0 ; j < olen ; j++)
                {
                  // console.log("<input name=" + "'" + result[i]["qid"] + "'" +  " type='radio' id=" + "'" + result[i]["qid"] +  "'" + " value=" + "'" + result[i]["qid"]+"-"+result[i]["type"]+ j + "'" +  " />" + " <label for=" + "'" + result[i]["qid"]  + "'" + ">" + options[j]["answer_option"] + "</label>") ;
                  $("#options").append("<input name=" + "'" + result[i]["qid"] + "'" +  " type='radio' id=" + "'" + result[i]["qid"]+j +  "'" + " value=" + "'" + result[i]["qid"]+"-"+result[i]["type"]+'-'+ j + "'" +  " />" + " <label for=" + "'" + result[i]["qid"]+j  + "'" + ">" + optarr[j] + "</label><br>") ;
                }

              }
              if(result[i]["type"] == "2")
              {
                console.log("input");
                var inputhtml = "<h4 class='header'>" + result[i]['question'] + "</h4>" ;
                inputhtml += '<textarea id="input-'+result[i]['qid']+'" class="materialize-textarea" length="120"></textarea><label for="input-'+result[i]['qid']+'">Input Answer</label>'
                $("#input-content").append(inputhtml) ;
              }
              if(result[i]["type"] == "3")
              {
                console.log("rank");
                $("#options").append("<h4 class='header'>" + result[i]['question'] + "</h4>") ;
                var rankarr = ["Very Satisfied" , "Satisfied" , "Neutral" , "Somewhat Satisfied" , "Not at all Satisfied"] ;
                for(var j = 0 ; j < 5 ; j++){
                  $("#options").append("<input name=" + "'" + result[i]["qid"] + "'" +  " type='radio' id=" + "'" + result[i]["qid"]+j +  "'" + " value=" + "'" + result[i]["qid"]+"-"+result[i]["type"]+'-'+ j + "'" +  " />" + " <label for=" + "'" + result[i]["qid"]+j  + "'" + ">" + rankarr[j] + "</label><br>")
                }

              }
              if(result[i]["type"] == "4")
              {
                $("#options").append("<h4 class='header'>" + result[i]['question'] + "</h4>") ;
                var custarr = ["custom option 1" , "custom option 2" , "custom option 3" , "custom option 4" , "custom option 5"] ;
                for(var j = 0 ; j < 5 ; j++){
                  $("#options").append("<input name=" + "'" + result[i]["qid"] + "'" +  " type='radio' id=" + "'" + result[i]["qid"]+j +  "'" + " value=" + "'" + result[i]["qid"]+"-"+result[i]["type"]+'-'+ j + "'" +  " />" + " <label for=" + "'" + result[i]["qid"]+j  + "'" + ">" + custarr[j] + "</label><br>")
                }
                console.log("custom");
              }
            }
          }
        })
      }
    })
  })
  </script>

  <body>
  <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo" style="color:black">Logo</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Navbar Link</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
          <li><a href="#">Navbar Link</a></li>
          <li><a href="#">Voting</a></li>
          <li><a href="takesurvey.php">Take Survey</a></li>
          <li><a href="#">Login</a></li>
          <li><a href="#">Sign Up</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
  </nav>

  <div class="container">
  <div id="head-survey" class="center text-center">
  </div>
    <div id="heading">
      <div id="main-content">
        <div id="options">
                                                <!-- here goes the question -->
                                              <!-- here goes the options of the questions -->
        </div>
      </div>
    </div>


    <div id="input-content">
    </div>

        <div class="row">
				<div class="col m12 center">
				<button id="bt" class="btn blue">Submit Response</button>
				</div>
				</div>

</div>


  <footer class="page-footer teal">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Company Bio</h5>
            <p class="grey-text text-lighten-4">We are a team of college students working on this project like its our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Settings</h5>
            <ul>
              <li><a class="white-text" href="#!">Link 1</a></li>
              <li><a class="white-text" href="#!">Link 2</a></li>
              <li><a class="white-text" href="#!">Link 3</a></li>
              <li><a class="white-text" href="#!">Link 4</a></li>
            </ul>
          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Connect</h5>
            <ul>
              <li><a class="white-text" href="#!">Link 1</a></li>
              <li><a class="white-text" href="#!">Link 2</a></li>
              <li><a class="white-text" href="#!">Link 3</a></li>
              <li><a class="white-text" href="#!">Link 4</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
      </div>
  </footer>
  </body>
  </html>
