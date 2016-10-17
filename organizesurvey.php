<?php
$surveyid = $_GET['surveyid'] ;

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
  .cir{
    height: 160px ;
    width: 100px ;
    /*border-style: hidden;
    border-radius: 200px ;*/
  }
  #step1{
    height: 140px ;
    width: 140px ;
    border-radius: 150px ;
  }
  #step2{
    height: 140px ;
    width: 140px ;
    border-radius: 150px ;
  }
  #step3{
    height: 140px ;
    width: 140px ;
    border-radius: 150px ;
  }
  </style>
</head>
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

<div class="organize">
  <h3 class="center deep-orange-text">Organize your Survey</h3>
  <h5 class="center  brown-text">3 Simple Steps</h5>
  <br>
  <div class="row">
    <div class="col s4 teal darken-4 center offset-s2" id="step1">
      <h6 class="white-text">Choose the number of surveys. </h6>
    </div>
    <div class="col s4 deep-orange darken-4 center offset-s2" id="step2">
      <br>
      <br>
      <h6 class="white-text">Select or post the questions of the survey.</h6>
    </div>
    <div class="col s4 pink darken-4 center offset-s2" id="step3">
      <h6 class="white-text">Get the shareable link.</h6>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col s12 m12 l12 center">
      <a class="btn center" href="inputquestion.php?surveyid=<?php echo $surveyid ?>">START</a>
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
