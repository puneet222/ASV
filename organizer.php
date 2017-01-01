<?php
include('dbcon.php') ;
session_start() ;
$sid = $_SESSION['surveyid'] ;
$query = 'SELECT * FROM `survey` WHERE survey_id="'.$sid.'"' ;
$result = $conn->query($query) ;
$row = $result->fetch_assoc() ;
$surveyid = $row['survey_id'] ;
$organization = $row['organisation'] ;
$auth = $row['auth'] ;
$head = $row['survey_heading'] ;
$fname = $row['first_name'] ;
$lname = $row['last_name'] ;
$email = $row['email_id'] ;
$start = $row['start'] ;
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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    var srt = <?php echo $start ?> ;
    if(srt == 1){
      $("#start").addClass('disabled') ;
    }
    var auth = <?php echo $auth ?> ;
    if(auth == 0){
      $("#mail").addClass('disabled') ;
    }
    var changevalue = "" ;
    var column = "" ;
    $(".medit").click(function(){
      var col = $(this).attr("id") ;
      console.log(col) ;
      var text = $("#"+col).html() ;
      console.log(text) ;
      $("#edit-text").val(text) ;
      $("#modal1").openModal() ;
      column = col ;
    })
    $("#edit-btn").click(function(){
      var newText = $("#edit-text").val() ;
      $("#"+column).text(newText) ;
      update(column , newText) ;
    })
    function update(col , newText){
      console.log(col  + newText) ;
      var query = "UPDATE `survey` SET `"+col+"`"+"='"+newText+"' WHERE survey_id='"+'<?php echo $sid?>'+"'" ;
      console.log(query) ;
      $.ajax({
        type:"POST",
        url : "updateprofile.php",
        data : "query=" + query ,
        cache : false,
        success : function(result){
          console.log(result) ;
          $("#edit-text").text("") ;
        }
      })
    }

    $("#start").click(function(){
      $.ajax({
        url:'startsurvey.php' ,
        cache : false,
        success : function(result){
          console.log(result) ;
          $("#modal2").openModal() ;
          $("#start").addClass('disabled') ;
					$("#stop").removeClass('disabled');
					$("#result").removeClass('disabled') ;
        }
      })
    })

    $("#share").click(function(){
      $("#modal3").openModal() ;
			$("#result").removeClass('disabled') ;
    })

    $("#result").click(function(){
      window.location.href = "results.php?surveyid=" + "<?php echo $sid ?>" ;
    })

		$("#stop").click(function(){
			$.ajax({
				url:'stopsurvey.php',
				cache:false,
				success:function(result){
					console.log(result) ;
					$("#modal4").openModal() ;
					$("#start").removeClass('disabled') ;
					$("#stop").addClass('disabled');
				}
			}) // ajax end
		})  // end stop button function
  })
  </script>
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


<div class="container">
  <h2 class="header center" style="color:#0d47a1;">User Account</h2>
  <div class="container">
    <ul class="collection with-header">
        <li class="collection-header"  style="background-color:#a7ffeb; border-radius:5px;"><h5 class="header center"><b>First Name</b> : </h5><h5 class="header center medit" id="first_name"><?php echo $fname?><i class="material-icons">border_color</i></h5></li>
        <li class="collection-header" style="background-color:#84ffff;border-radius:5px;"><h5 class="header center"><b>Last Name</b> : </h5><h5 class="header center medit" id="last_name"><?php echo $lname?></h5></li>
        <li class="collection-header"  style="background-color:#80d8ff; border-radius:5px;"><h5 class="header center"><b>SurveyID</b> : </h5><h5 class="header center medit"><?php echo $sid?></h5></li>
        <li class="collection-header" style="background-color:#40c4ff; border-radius:5px;"><h5 class="header center"><b>Organisation</b> : </h5><h5 class="header center medit" id="organisation"><?php echo $organization?></h5></li>
        <li class="collection-header"  style="background-color:#00b0ff;border-radius:5px;"><h5 class="header center"><b>Survey</b> : </h5><h5 class="header center medit" id="survey_heading" ><?php echo $head?></h5></li>
        <li class="collection-header" style="background-color:#0091ea;border-radius:5px; "><h5 class="header center"><b>Email ID</b> : </h5><h5 class="header center medit" id="email_id"><?php echo $email?></h5></li>
    </ul>
  </div>
	<div class="container">
		<div class="row">
	    <div class="col s2 m3 l6 center">
	      <a class="btn green darken-4" id="start"style="border-radius:5px;">Start Survey
					<i class="material-icons">play_arrow</i></a>
	    </div>
	    <div class="col s2 m3 l6 center">
	      <a  class="btn light-blue darken-4" id="result" class="disabled"style="border-radius:5px;">Show Results
				<i class="material-icons">format_list_numbered</i></a>
	    </div>
	  </div>
		<div class="row">
			<div class="col s2 m3 l6 center">
				<a class="btn deep-orange accent-3" id="share"style="border-radius:5px;">Sharable link
				<i class="material-icons">attach_file</i></a>
			</div>
			<div class="col s2 m3 l6 center">
				<a class="btn purple darken-4" id="mail"style="border-radius:5px;">Send Mail
					<i class="material-icons">contact_mail</i></a>
			</div>
		</div>
		<div class="row">
			<div class="col s2 m4 l12 center ">
				<a class="btn red accent-4 center" id="stop"style="border-radius:5px;">Stop Survey
					<i class="material-icons">warning</i></a>
			</div>
		</div>
	</div>

</div>

<div id="modal1" class="modal">
    <div class="modal-content">
      <textarea id="edit-text" class="materialize-textarea"></textarea>
      <label for="edit-text">EDIT</label>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat deep-orange darken-3 white-text" id="edit-btn">EDIT</a>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content">
      <h4 class="header center">Your Survey has been started</h4>
    </div>
</div>

<div id="modal3" class="modal">
    <div class="modal-content">
      <h4 class="header center">"localhost/project5/ASV/endusertakesurvey.php?surveyid="<?php echo $sid ?></h4>
    </div>
</div>

<div id="modal4" class="modal">
	<div class="modal-content">
		<h4 class="header center">Your Survey has been stopped!!</h4>
	</div>
</div>
<!--  footer  -->
<footer class="page-footer teal">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">About Us:</h5>
				<p class="grey-text text-lighten-4">We are a team of college students working on this project. At PEC University of Technology, Sector-12,  Chandigarh</p>


			</div>

			<div class="col l3 s12">
<!--          <h5 class="white-text">Profile:</h5>-->

			</div>

			<div class="col xs">
<!--
					<ul>
							<li>
									<div class="row"><div class="col-xs-2"><h6 class="white-text">
									<a class="white-text text-lighten-3"href="http://www.facebook.com/profile.php?id=100006936708975&fref=ts">Puneet Agarwal</a></h6></div>
									<div class="col-xs-2 white-text">14103029</div>
									</div>
							</li>
							<li>
									<div class="row"><div class="col-xs-2">
									<h6 class="white-text">
									<a class="white-text text-lighten-3"href="http://www.facebook.com/arvind.dhanda.33">Arvind</h6></div>
									</div>
							</li>

							<li><h6 class="white-text">
								 <a class="white-text text-lighten-3"href="http://www.facebook.com/smart.gupta1"> Rahul Gupta</h6></li>
					</ul>
-->
	 <table class="centered responsive-table white-text">
			<tbody>
				<tr>
					<td><a class="white-text text-lighten-3"href="http://www.facebook.com/profile.php?id=100006936708975&fref=ts">Puneet Agarwal</a></td>
					<td>14103029</td>
				</tr>
				<tr>
						<td><h6><a class="white-text text-lighten-3"href="http://www.facebook.com/arvind.dhanda.33">Arvind</a></h6></td>
					<td>14103044</td>
				</tr>
				<tr>
					<td><h6 class="white-text">
							<a class="white-text text-lighten-3"href="http://www.facebook.com/smart.gupta1"> Rahul Gupta</a>
							</h6></td>
					<td>14103070</td>
				</tr>
			</tbody>
		</table>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container center">
		Made with <i class="material-icons">favorite</i>
		</div>
	</div>
</footer>

</body>
</html>
