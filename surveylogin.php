<?php
$sid = $_GET["surveyid"] ;
// echo $sid ;
?>
<!DOCTYPE html>
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

  <style type="text/css">
		body{
			background-color: #009688 ;
		}
    #loginval{
      background-color: white ;
      margin-top : 5% ;
      margin-left : 30% ;
      margin-right: 50% ;
      width: 500px ;
      /*border-style: solid;*/
      /*border-color: black ;*/
      border-radius: 15px ;
      box-shadow: 5px 5px 5px #004D40;

    }
    #lsubmit{
      width: 100% ;
      margin-left: 5px ;
      margin-right: 5px ;
      background-color: #01579B ;
    }
    #lsign{
      width: 100% ;
      margin-left: 5px ;
      margin-right: 5px ;
      background-color: #FF9800 ;
    }
  </style>

</head>

<script type="text/javascript">
$("#incorrect").hide() ;
$(document).ready(function(){
  $("#incorrect").hide() ;

  $("#lsubmit").click(function(){
    // alert("asc0") ;
    var email = $("#eid").val() ;
    var pass = $("#pass").val() ;
    // console.log("email : " + email + " pass : " + pass) ;
    var dat = "email=" + email + "&pass=" + pass ;

    $.ajax({
      type : "POST",
      url : "loginresponse.php" ,
      data : dat,
      cache : false ,
      success : function(result){
        console.log(typeof result) ;
        console.log(result) ;
        if(result == 1)
        {
          // redirect to the survey
          var url = "survey.php?email="+email+"&surveyid=<?php echo $sid ?>" ;
          console.log(url) ;
          window.location = url;
        }
        else{
          // display the message of wrong username and password
          console.log(result == "valid") ;
          console.log(result === "valid") ;
          alert("Incorrect email or password") ;
        }
      }

    })

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

<div id="login-div">
<div id="sinfo" class="center">
  <h2 id="info-text" style="color:white">Please login</h2>
</div>
<div id="loginval">
<div class="row">
    <!-- <form class="col s12"  method="post" name="survey-id"> -->
      <div class="row">
      <div id="incorrect" class="center">
      <h6 style="color:red">Incorrect Survey ID or Password</h6>
      </div>   													<!--   SURVEY ID   -->
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="eid" type="text" class="validate">
          <label for="eid">Email Id</label>
        </div>
        <div class="input-field col s12">             						 <!--    PASSWORD     -->
          <i class="material-icons prefix">lock</i>
          <input id="pass" type="password" class="validate" name="password">
          <label for="pass">Password</label>
        </div>
        <div class="input-field col s12">             						 <!--    Login BUTTON     -->
          <a class="btn" id="lsubmit">Authorize</a>
        </div>
      </div>
    <!-- </form> -->
  </div>
</div>
</div>

<footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


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
