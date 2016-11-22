<?php
$email = $_GET['email'] ;
$sid = $_GET['surveyid'] ;

echo $email ;
echo $sid ;

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

    $('.myForm input').on('change', function() {
    console.log($('input[name=group1]:checked', '.myForm').val());
    });

    $("#bt").click(function(){
      var test = $("#test1").checked ;
      console.log(test) ;
      console.log($('input[name=group1]:checked').val());
      console.log($('input[name=group2]:checked').val());
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
                var opt = getOptions(result[i]["qid"] , options) ;
                console.log(opt) ;



              }
              if(result[i]["type"] == "2")
              {
                console.log("input");
              }
              if(result[i]["type"] == "3")
              {
                console.log("custom");
              }
              if(result[i]["type"] == "4")
              {
                console.log("rank");
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

    <div id="heading">
      <div id="main-content">
        <div id="question">
          <!-- here goes the question -->
        </div>
        <div id="options">
          <!-- here goes the options of the questions -->
        </div>
      </div>
    </div>

    <form action="#" class="myForm">
        <p>
          <input name="group1" type="radio" id="test1" value="red" />
          <label for="test1">Red</label>
        </p>
        <p>
          <input name="group1" type="radio" id="test2" value="yell"/>
          <label for="test2">Yellow</label>
        </p>
        <p>
          <input class="with-gap" name="group1" type="radio" id="test3"  value="gre"/>
          <label for="test3">Green</label>
        </p>
      </form>

      <form action="#" class="myForm">
          <p>
            <input name="group2" type="radio" id="test12" value="yelloq" />
            <label for="test12">Red</label>
          </p>
          <p>
            <input name="group2" type="radio" id="test22" value="yell2" />
            <label for="test22">Yellow</label>
          </p>
          <p>
            <input class="with-gap" name="group2" type="radio" id="test32" value="gre2" />
            <label for="test32">Green</label>
          </p>

        </form>

        <button id="bt">test</button>

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
