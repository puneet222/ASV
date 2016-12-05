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
  <script src="a.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  <script type="text/javascript">
    $("#upld").hide(10) ;
    $(".jupload").hide() ;
    $("#ifsignup").hide() ;
    $("#login-div").hide() ;
    $("#incorrect").hide() ;
    console.log("javascript") ;
    $('document').ready(function(){

      $("#incorrect").hide() ;
      console.log("writing javascript") ;
      $("#upld").hide() ;
      $("#ifsignup").hide() ;

      $("#open").click(function(){
        $("#upld").fadeOut() ;
      })

      $("#auth").click(function(){
          $("#excel").openModal();
          $("#upld").slideDown() ;
        })
      $("#modalclose").click(function(){
        $("#excel").closeModal();

      });

      $("#lsign").click(function(){
        // alert("click") ;
        $("#login-div").hide("slow" , function(){
          $("#ifsignup").show("slow") ;
        }) ;
      })

      $("#ins-log").click(function(){
        // alert("vbjvbr") ;
        $("#ifsignup").hide("slow" , function(){
          $("#login-div").show("slow") ;
        }) ;
      })

      $("#lsubmit").click(function(){
        var survey_id = $("#sid").val() ;
        var password = $("#spass").val() ;
        var dataString = 'surveyid=' + survey_id + "&password=" + password ;
        if(survey_id == "" || password == "")
        {
          alert("Please Complete the Login field") ;
        }
        $.ajax({
        type: "POST",
        url: "login_backend.php",
        data: dataString,
        cache: false,
        success: function(result){
          // alert(result) ;
          var l = result.length ;
          // alert(l) ;
        if(l == 6)
        {
          //redirect to another page
          // alert(survey_id) ;
          // alert("correct") ;
          var loc = "organizesurvey.php?surveyid="+ survey_id ;
          window.location.href = loc;
        }
        else
        {
          // alert(result) ;
          $("#incorrect").show("slow") ;
        }
        }
        });
      })
    });
  </script>

  <title>Take Survey</title>

  <style type="text/css">
    body{
      background-color: #009688 ;
    }
    .signupdiv{
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
    /*#first_name{
      background-color: white ;
    }*/
    #submit{
      width: 100% ;
      margin-left: 0px ;
      margin-right: 15px ;
      margin-bottom: 15px ;
      margin-right: 15px ;
      background-color: #FF9800 ;
    }
    #sinfo{
      font-family: 'PT Sans', sans-serif;
    }
    #info-text{
      color : white;
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

    #ins-log{
      background-color: #BF360C;
      margin-left : 30% ;
      margin-right: 50% ;
      color: white ;
    }

  </style>



</head>
<body>
<!-- -----------------------------MODAL FOR EXCEL----------------------------------- -->
<div class = "modal" id = "excel">

  <div class = "modal-content" id = "econtent">
    <div id = "modal_head">
      <div id = "modal_head_1"><center><h5>
        Instructions for Authorized survey
      </h5></center></div>
    </div><!-- modal head -->
 <center>For conducting authorized survey you need to upload an excel file which should have 3 Columns :
 </center>
 <BR>
 <ul>
   <li>First Column should have First Name
  <li>Second Column should have Last Name
  <li>Third Column should have Email Addresses
 </ul>

  <button id = "modalclose" class = "btn">OK</button>
  </div><!-- modal content-->
</div><!--modal = excel-->
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
  <h2 id="info-text">Please login</h2>
</div>
<div id="loginval">
<div class="row">
    <!-- <form class="col s12"  method="post" name="survey-id"> -->
      <div class="row">
      <div id="incorrect" class="center">
      <h6 style="color:red">Incorrect Survey ID or Password</h6>
      </div>                            <!--   SURVEY ID   -->
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="sid" type="text" class="validate">
          <label for="sid">Survey Id</label>
        </div>
        <div class="input-field col s12">                          <!--    PASSWORD     -->
          <i class="material-icons prefix">lock</i>
          <input id="spass" type="password" class="validate" name="password">
          <label for="spass">Password</label>
        </div>
        <div class="input-field col s6">                         <!--    Login BUTTON     -->
          <a class="btn" id="lsubmit">Login</a>
        </div>
        <div class="input-field col s6">                         <!--   Signup BUTTON     -->
          <a class="btn" id="lsign">Signup</a>
        </div>
      </div>
    <!-- </form> -->
  </div>
</div>
</div>

<div id="ifsignup" >
<div id="sinfo" class="center">
  <h2 id="info-text">Please Signup</h2>
</div>

<div class="signupdiv">
<div class="row">
      <form class="col s12" id="signup" method="post" enctype="multipart/form-data" action = "survey_backend.php">
      <div class="row">     <!-- first row                  First name   and   Last Name-->
        <div class="input-field col s6">
          <input  id="first_name" type="text" class="validate"  name = "first_name" >
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate"  name = "last_name">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <!-- <div class="row">          second row
        <div class="input-field col s12">
          <input disabled value="I am not editable" id="disabled" type="text" class="validate">
          <label for="disabled">Disabled</label>
        </div>
      </div> -->
      <div class="row">          <!-- second row                Oragnisation   Name  -->
        <div class="input-field col s12">
          <input id="organisation" type="text" class="validate"  name = "org_name">
          <label for="Organisation Name">Oragnisation Name</label>
        </div>
      </div>
      <div class="row">          <!-- third row               Password        -->
        <div class="input-field col s12">
          <input id="password" type="password" class="validate"   name = "password">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">          <!-- forth row             Re - enter    Password     -->
        <div class="input-field col s12">
          <input id="repassword" type="password" class="validate" >
          <label for="repassword">Re-enter Password</label>
        </div>
      </div>

      <div class="input-field col s12">                          <!--  NAME OF   the survey   -->
          <input id="survey_heading" type="text" class="validate" name = "survey_heading">
          <label for="survey_heading">Name of survey</label>
        </div>
      </div>

      <div class="row">          <!-- fifth  row           email  id          -->
        <div class="input-field col s12">
          <input id="email" type="email" class="validate"  name = "email">
          <label for="email">Email</label>
        </div>
        <div class="row">          <!-- seventh row          radio button         -->
        <div class="input-field col s6">
          <p>
          <input name="type" type="radio" id="open" value="open">
          <label for="open">Open</label>
        </p>
        </div>
        <div class="input-field col s6">
          <p>
          <input name="type" type="radio" id="auth" value="auth">
          <label for="auth">Authorized</label>
        </p>
        </div>

      <div class="row"  class="jupload">           <!-- sixth  row          uplaod file       -->
        <div class="input-field col s12" >
          <div class="file-field input-field" id="upld">
        <div class="btn">
          <span>File</span>
          <input type="file" name = "a">
          </div>
          <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
          </div>
        </div>
        </div>
      </div>
       </div>
      </div>
      <div class="row">          <!-- sixth  row          signup button         -->
        <div class="input-field col s12">
          <input type="submit" value="Sign Up" class='btn' id="submit">
        </div>
      </div>
    </form>
    </div>
  <div id="insign-login">                               <!--     SMALL    LOGIN LINK IN SIGN UP page    -->
    <button id="ins-log" class="center btn">Login</button>
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
