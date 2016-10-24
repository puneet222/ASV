<?php
session_start() ;
$surveyid = $_SESSION["surveyid"] ;
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


<style type="text/css">
#image{
  position: relative;
  left: 50px ;
}
</style>

<script type="text/javascript">
// -- -----------------------     JAVA SCRIPT     ------------------------- -->
$("#catmcq").hide() ;
$("#catrank").hide() ;
$("#catcust").hide() ;
$("#catinput").hide() ;

$(document).ready(function(){
  $("#catmcq").hide() ;
  $("#catrank").hide() ;
  $("#catcust").hide() ;
  $("#catinput").hide() ;

	$("#input-question").characterCounter(); // -------- for character Counting event

  $("#mcq").click(function(){
    $("#category").hide("slow" , function(){
      $("#catmcq").show("slow") ;
    }) ;
  })

  $("#rank").click(function(){
    $("#category").hide("slow" , function(){
      $("#catrank").show("slow") ;
    }) ;
  })

  $("#cust").click(function(){
    $("#category").hide("slow" , function(){
      $("#catcust").show("slow") ;
    }) ;
  })

  $("#input").click(function(){
    $("#category").hide("slow" , function(){
      $("#catinput").show("slow") ;
    }) ;
  })

  $(".showcat").click(function(){  // show category click button
    $("#catmcq").hide() ;
    $("#catrank").hide() ;
    $("#catcust").hide() ;
    $("#catinput").hide() ;
    $("#category").show("slow") ;
  })

  function getQuestion(type) // ---------- Get Question function for the modal
  {
    var dataString = "type=" + type ;
    $.ajax({
      type: "POST",
      url: "getdbquestion.php",
      data: dataString,
      cache: false,
      success: function(result){
      console.log(result);
      var object = JSON.parse(result) ;
      var size = object.length ;
      console.log("size is : " + size) ;
      console.log(object[0]["qid"]) ;
      //---------------------------------------------------creating a question modal
      var html = "" ;
      for(var i = 0 ; i < size ; i++)
      {
        html = html + "<input type='checkbox' id=" + "'" + object[i]["qid"] + "'" + " value=" + "'" +object[i]["qid"] + "'" +"/>" +
        "<label for=" + "'" +object[i]["qid"] + "'" + "><h5 class='brown-text center'> " + object[i]["question"] + "</h5></label><br><br>" ;
      }
      console.log(html) ;
      $("#qcontent").html(html) ;
      $("#modal1").openModal();
      }
      });
  }

	var type = "" ;  // global variable for getting the question

	function putQuestion(t)   // ---------  forsetting the value of type variable
	{														//  ---- and updating the global variable for use
		type = "," + t ;
	}


  // ----------------------------------------------button for sending the selected questions
  $("#qadd").click(function(){
    var add = "" ;
    $('input:checked').each(function() {
      add = add+this.value+"," ;
    });
    var sid = "<?php echo $surveyid ; ?>" ;
    console.log(sid) ;
    console.log(add) ;
    $.ajax({
      type:"POST",
      url:"updatedbquestions.php?surveyid=" + sid ,
      data: "qid="+add ,
      cache:false ,
      success:function(result){
        console.log(result) ;
      }
    });
  })

/* ------------------------------------   Button for adding the Questions along with the optins  -------- */

	$("#input-add").click(function(){
		inputdata = $("#input-question").val() ;
		var send_data = "" ;
		inputdata = inputdata + type ;
		if(type == ",1")   // if the type is mcq then we also have to send the options
		{
			var option = $('.chips').material_chip('data');
			var send_option = "" ;
			for(var i = 0 ; i < (option.length - 1) ; i++)
			{
				send_option = send_option + option[i]["tag"] + "," ;
			}
			send_option = send_option + option[option.length - 1]["tag"] ;
			console.log(send_option) ;
			send_data = "question=" + inputdata + "&option=" + send_option ; // change the send data variable accordingly
		}
		else {
			send_data = "question=" + inputdata ;
		}
		$.ajax({
			type: "POST" ,
			url:"putquestion.php" ,
			data:send_data ,
			cache:false ,
			success:function(result){
				console.log("input question debuging") ;
				console.log(result) ;
				$("#input-question").val("") ; // deleting the value of the modal
			}
		});
	})

	/* ------------------   Database  Question ---------------------*/

  $("#dbmcq").click(function(){
    // alert("clciked") ;
    getQuestion(1) ;
  })

  $("#dbrank").click(function(){
    // alert("clciked") ;
    getQuestion(3) ;
  })

  $("#dbcust").click(function(){
    // alert("clciked") ;
    getQuestion(4) ;
  })

  $("#dbinput").click(function(){
    // alert("clciked") ;
    getQuestion(2) ;

  })

	/* --------------------------------------------------------------*/



	/* ------------------   Custom User Question  Question ---------------------*/

	$("#custmcq").click(function(){
		putQuestion(1) ;
		$("#modal2").openModal();
	})

	$("#custinput").click(function(){
		putQuestion(2) ;
		$("#modal2").openModal() ;
	})

	$("#custrank").click(function(){
		putQuestion(3) ;
		$("#modal2").openModal() ;
	})

	$("#custcust").click(function(){
		putQuestion(4) ;
		$("#modal2").openModal() ;
	})

	//   ----------------  adding option chips --------------------------------
	$('.chips').material_chip();
	$('.chips-placeholder').material_chip({
	    placeholder: 'Enter a Option',
	    secondaryPlaceholder: '+Option',
	  });

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
  <div id="category">
    <h4 class="center teal-text">SELECT Category</h4>
    <br>
    <div class="row">
      <div class="col s3 l3 m3 center">
        <a class="btn red darken-4" id="mcq">MCQ</a>
      </div>
      <div class="col s3 l3 m3 center">
        <a class="btn purple darken-4" id="rank">Ranking</a>
      </div>
      <div class="col s3 l3 m3 center">
        <a class="btn green darken-4" id="cust">Custom</a>
      </div>
      <div class="col s3 l3 m3 center">
        <a class="btn deep-orange darken-4" id="input">Input</a>
      </div>
    </div>
  </div>

  <div id="catmcq">  <!--                                   MCQ CATEGORY   -->
    <h4 class="center teal-text">Multiple Choice Question</h4>
    <br>
    <div id="image">
      <img class="center" src="background33.jpg" height="400px" width="800px">
    </div>
    <br>
    <div class="row">
      <div class="col s6 m6 l3 center">
        <a class="btn deep-orange darken-3" id="dbmcq">Database</a>
      </div>
      <div class="col s6 m6 l3 center">
        <a class="btn purple darken-4" id="custmcq">Custom</a>
      </div>
    <!-- </div>
    <div class="row"> -->
      <div class="col s6 l3 m6 center">
        <a class="btn pink darken-2 showcat">Show Categories</a>
      </div>
			<div class="col s6 l3 m6 center">
				<a class="btn light-blue darken-4 showcat" href="preview.html">Preview</a>
			</div>
    </div>
  </div>

  <div id="catrank">  <!--                                   Ranking CATEGORY   -->
    <h4 class="center teal-text">Ranking Based Question</h4>
    <br>
    <div id="image">
      <img class="center" src="background33.jpg" height="400px" width="800px">
    </div>
    <br>
    <div class="row">
      <div class="col s6 m6 l3 center">
        <a class="btn deep-orange darken-3" id="dbrank">Database</a>
      </div>
      <div class="col s6 m6 l3 center">
        <a class="btn purple darken-4" id="custrank">Custom</a>
      </div>
    <!-- </div>
    <div class="row"> -->
      <div class="col s6 l3 m6 center">
        <a class="btn brown darken-2 showcat">Show Categories</a>
      </div>
			<div class="col s6 l3 m6 center">
				<a class="btn light-blue darken-4 showcat" href="preview.html">Preview</a>
			</div>
    </div>
  </div>

  <div id="catcust">  <!--                                  Custom CATEGORY   -->
    <h4 class="center teal-text">Custom Question</h4>
    <br>
    <div id="image">
      <img class="center" src="background33.jpg" height="400px" width="800px">
    </div>
    <br>
    <div class="row">
      <div class="col s6 m6 l3 center">
        <a class="btn deep-orange darken-3" id="dbcust">Database</a>
      </div>
      <div class="col s6 m6 l3 center">
        <a class="btn purple darken-4" id="custcust">Custom</a>
      </div>
    <!-- </div>
    <div class="row"> -->
      <div class="col s12 l3 m12 center">
        <a class="btn brown darken-2 showcat">Show Categories</a>
      </div>
			<div class="col s6 l3 m6 center">
				<a class="btn light-blue darken-4 showcat" href="preview.html">Preview</a>
			</div>
    </div>
  </div>

  <div id="catinput">  <!--                                   INPUT CATEGORY   -->
    <h4 class="center teal-text">Input Question</h4>
    <br>
    <div id="image">
      <img class="center" src="background33.jpg" height="400px" width="800px">
    </div>
    <br>
    <div class="row">
      <div class="col s6 m6 l3 center">
        <a class="btn deep-orange darken-3" id="dbinput">Database</a>
      </div>
      <div class="col s6 m6 l3 center">
        <a class="btn purple darken-4" id="custinput">Custom</a>
      </div>
    <!-- </div>
    <div class="row"> -->
      <div class="col s12 l3 m12 center">
        <a class="btn brown darken-2 showcat">Show Categories</a>
      </div>
			<div class="col s6 l3 m6 center">
				<a class="btn light-blue darken-4 showcat" href="preview.html">Preview</a>
			</div>
    </div>
  </div>





</div>

<!-- -------------------------------------------------------------------------------------- QUESTION  MODAL --------------------------------------------   -->
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4 id="qhead" class="header center">Question Bank</h4>
      <br>
      <div id="qcontent">
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat deep-orange darken-3 white-text" id="qadd">Add</a>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content">
      <h4 id="input-head" class="header center">Input Question</h4>
      <br>
      <div id="input-content">
				<div class="row">
          <div class="input-field col s12 l12">
            <textarea id="input-question" class="materialize-textarea" length="120"></textarea>
            <label for="input-question">Input Question</label>
						<h5 class="header">Adding options just by entering</h5>
						<div class="chips chips-placeholder"></div>

          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat deep-orange darken-3 white-text" id="input-add">Add</a>
    </div>
</div>




<footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Automated Survey and Voting</h5>
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
