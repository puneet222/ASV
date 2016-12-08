<?php
session_start() ;
$surveyid = $_SESSION["surveyid"] ;
include('dbcon.php') ;
$query = 'SELECT * FROM `survey` WHERE survey_id="'.$surveyid.'"' ;
// echo $query ;
$result = $conn->query($query) ;
$row = $result->fetch_assoc() ;
$start = $row['start'] ;
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
if($start == 1){
  Redirect("preview.html") ;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Preview Page</title>
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

  </head>
  <!-- ------------------ CSS --------------------- -->
  <style type="text/css">

  </style>
  <script type="text/javascript">
    $(document).ready(function(){
      function getOptions(qid , option){
        var olen = option.length ;
        for(var i = 0 ; i < olen ; i++)
        {
          if(option[i]['qid'] == qid){
            return option[i]['answer_option'] ;
          }
        }
      }
      // $("#show").click(function(){
        $.ajax({
          type:"GET",
          url:"previewquestion.php" ,
          cache:false ,
          success:function(result){
            console.log(result) ;
            // got the data as a result
            var arr = result.split("-{]&%this_is_split$#%[{-")
            var object = JSON.parse(arr[0]) ; // parse the data as json object
            var option_object = JSON.parse(arr[1]) ;
            console.log(option_object) ;
            var length = object.length ;
            console.log(object) ;
            // got all the question
            // now the task is show all the questions with options on cards in
            // a division

            // making the division
            var question = ' <div class="row"> <div class="col s12 m12"> <div class="card blue-grey darken-1" id="div-idd"> <div class="card-content white-text"><p>How would you rate the quality of the class room ?</p>' ;
                            // <input name="group1" type="radio" id="test1" class="white-text"/>
                            // <label for="test1">Very Satisfied</label>
                            // <input name="group1" type="radio" id="test1" class="white-text"/>
                            // <label for="test1">Satisfied</label>
                            // <input name="group1" type="radio" id="test1" class="white-text"/>
                            // <label for="test1">Neutral</label>
                            // <input name="group1" type="radio" id="test1" class="white-text"/>
                            // <label for="test1">Not very Satisfied</label>
                            // <input name="group1" type="radio" id="test1" class="white-text"/>
                            // <label for="test1">Not at all Satisfied</label>
          var down = '</div <div class="card-action"> <a href="#" class="del" id="idd"><i  class="material-icons">delete</i></a> <a href="#"><i class="material-icons">mode_edit</i></a> </div> </div> </div> </div>' ;
console.log(question) ;
          var ap = question + down ;
          console.log(ap) ;
          for(var i = 0 ; i < length ; i++)
          {
            var qid = object[i]["qid"] ;
            var ques_type = qid.substr(0,qid.search(/\d+/g)) ;  // get the type of the question like for input65 it gives input65

            var ques = object[i]["question"] ;
            var question = ' <div class="row"> <div class="col s12 m12"> <div class="card blue-grey darken-1" id="div-' + qid + '"> <div class="card-content white-text"><p id="div1-'+ qid  +'">'+ ques +'</p>' ;
            var down = '</div <div class="card-action"> <a href="#" class="del" id="' + qid + '"><i  class="material-icons">delete</i></a> <a href="#" class="edit" id="'+ qid +'"><i class="material-icons">mode_edit</i></a> </div> </div> </div> </div>' ;

            var question2 = ' <div class="row"> <div class="col s12 m12"><ul class="collection with-header" id="div-' + qid + '"><li class="collection-header"><h4 id="div1-'+ qid  +'">'+ ques +'</h4></li>' ;
            var down2 = '  <li><div class="row" style="margin:5px;"> <div class="col s4 center"> <a href="#" class="edit btn blue" id="'+ qid +'"><i class="material-icons">mode_edit</i> Edit Question</a></div><div class="col s4 center"><a href="#" class="del btn red" id="' + qid + '"><i  class="material-icons">delete</i> Delete</div></a> <div class="col s4 center"><a class="option-edit btn pink"  id="'+ qid +'"><i class="material-icons">mode_edit</i>   Edit Option</div></a></div></li></div></ul></div></div>' ;
            if(ques_type == "mcq"){
              console.log("\nmcq\n");
              var dis_options = getOptions(qid , option_object) ;
              var option_array = dis_options.split(",") ;
              var option_div = "" ;
              for(var j = 0 ; j < option_array.length ; j++){
                option_div += ' <li class="collection-item option-' +qid+ '" >'+option_array[j]+'</li>' ;
              }
              console.log(question2+option_div+down2);
              $("#content").append(question2+option_div+down2).fadeIn(2000) ;
            }
            if(ques_type == "rank"){
              var rank_arr = ["Very Satisfied" , "Satisfied" , "Neutral" , "Somewhat Satisfied" , "Not Satisfied at all"] ;
              var option_div = "" ;
              for(var j = 0 ; j < 5 ; j++){
                option_div += ' <li class="collection-item option-' +qid+ '" >'+rank_arr[j]+'</li>' ;
              }
              var down3 = '  <li><div class="row" style="margin:5px;"> <div class="col s6 center"> <a href="#" class="edit btn blue" id="'+ qid +'"><i class="material-icons">mode_edit</i> Edit Question</a></div><div class="col s6 center"><a href="#" class="del btn red" id="' + qid + '"><i  class="material-icons">delete</i> Delete</div></a></li></div></ul></div></div>' ;
              $("#content").append(question2+option_div+down3).fadeIn(2000) ;
            }
            if(ques_type == "input"){
              var down3 = '  <li><div class="row" style="margin:5px;"> <div class="col s6 center"> <a href="#" class="edit btn blue" id="'+ qid +'"><i class="material-icons">mode_edit</i> Edit Question</a></div><div class="col s6 center"><a href="#" class="del btn red" id="' + qid + '"><i  class="material-icons">delete</i> Delete</div></a></li></div></ul></div></div>' ;
              $("#content").append(question2+down3).fadeIn(2000) ;
            }
            // $("#content").append(question+down).fadeIn(2000) ;
            // delay(1000) ;
          }

          }
        });
      })

      function deleteQuestion(qid){
        $.ajax({
          type : "POST",
          url: "deletepreview.php",
          data : "qid="+qid ,
          cache : false ,
          success : function(result){
            console.log(result) ;
          }
        })
      }

      $(document).on("click" , "#edit-modal-btn" , function(){
        var qid = $("#modal-question").attr("class") ;
        // removing the class of the input field of the  modal-question
        $("#modal-question").removeClass(qid) ;
        var question = $("#modal-question").val() ;
        $.ajax({
          type : "POST" ,
          url : "editpreview.php" ,
          data : "qid=" + qid + "&question=" + question ,
          cache : false ,
          success : function(result){
            console.log(result) ;
            $("#div1-"+qid).text(question) ;
          }
        })
      })

      $(document).on('click' , '#edit-options-btn' , function(){
        var new_options = $('.chips').material_chip('data');
        var qid = $("#old_options").attr("class") ;
        $("#old_options").removeClass(qid) ;
        var send_option = "" ;
  			for(var i = 0 ; i < (new_options.length - 1) ; i++)
  			{
  				send_option = send_option + new_options[i]["tag"] + "," ;
  			}
  			var optionlength = new_options.length ;
        send_option = send_option + new_options[new_options.length - 1]["tag"] ;
        console.log(send_option) ;
        var send_data = "options=" + send_option + "&optionlength=" + optionlength + "&questionid=" + qid ;
        console.log(send_data) ;
        $.ajax({
          type : "POST" ,
          url : "updateandeditoption.php" ,
          data : send_data ,
          cache : false ,
          success : function(result){
            console.log(result) ;
          }
        })
      })

      // ----- click function of delete button ----------------------------------------
      $(document).on('click' , '.del' , function(){
        // alert("click") ;
        var val = $(this).attr('id');
        console.log(val) ;
        var deldiv = "div-"+ val ;
        $("#"+deldiv).hide("slow") ;
        deleteQuestion(val) ;
      })

      // ------------- click function of options edit button -------------------------
      $(document).on('click' , '.option-edit' , function(){
        var val = $(this).attr('id') ;
        // console.log("value is : "+ val) ;
        console.log(val) ;
        var opt_data = $(".option-"+val).map(function() { return $(this).text(); }).get().join("|},{") ;
        // ---------------------------------------  got the question options data
        var opt_arr = opt_data.split("|},{") ;
        var disp_data = [] ;
        var option_html = '<ul class="collection">' ;
        for(var k = 0; k < opt_arr.length ; k++){
          disp_data.push({tag : opt_arr[k]}) ;
          option_html += '<li class="collection-item">'+opt_arr[k]+'</li>'
        }
        option_html += '</ul>' ;
        console.log(option_html);
        $("#old_options").html(option_html) ;
          $("#old_options").addClass(val) ;
        var option_json = {data: disp_data,} ;
        console.log(option_json);
        $('.chips').material_chip();
        $('.chips-initial').material_chip(option_json);
        $('.chips-placeholder').material_chip({
      	    placeholder: 'Enter a Option',
      	    secondaryPlaceholder: '+Option',
      	  });
          $("#old-options").addClass(val) ;
        $("#modal2").openModal() ;
      })

      $(document).on('click' , '.edit' , function(){
        var val = $(this).attr("id") ;
        console.log(val) ;
        var question = $("#div1-"+ val).text() ;
        console.log($("#div1-"+ val).text()) ;
        // $('.modal').modal();
        // console.log( $(".collection-item").map(function() { return $(this).text(); }).get().join("|},")  ) ;
        $("#modal-question").val(question) ;
        $("#modal-question").addClass(val) ;
        $('#modal1').openModal() ;
      })



    // })
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

      <!-- <button class="btn" id="show">Show</button> -->


      <div id="content">
        <div class="row">
          <div class="col s12 m12">
            <!-- <div class="card blue-grey darken-1" id="div-idd">
              <div class="card-content white-text">
                <span class="card-title">Card Title</span>
                <p>How would you rate the quality of the class room ?</p>
                <input name="group1" type="radio" id="test1" class="white-text"/>
                <label for="test1">Very Satisfied</label>
                <input name="group1" type="radio" id="test1" class="white-text"/>
                <label for="test1">Satisfied</label>
                <input name="group1" type="radio" id="test1" class="white-text"/>
                <label for="test1">Neutral</label>
                <input name="group1" type="radio" id="test1" class="white-text"/>
                <label for="test1">Not very Satisfied</label>
                <input name="group1" type="radio" id="test1" class="white-text"/>
                <label for="test1">Not at all Satisfied</label>
              </div>
              <div class="card-action">
                <a href="#" class="del" id="idd"><i  class="material-icons">delete</i></a>
                <a href="#"><i class="material-icons edit">mode_edit</i></a>
              </div>
            </div> -->
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12">
            <!-- <ul class="collection with-header">
              <li class="collection-header"><h4>How would you rate the quality of the class room ?</h4></li>

                <li class="collection-item">Very Satisfied</li>
                <li class="collection-item">Satisfied</li>
                <li class="collection-item">Not Very Satisfied</li>
                <li class="collection-item">Not at all Satisfied</li>
                <li><div class="row" style="margin:5px;"><div class="col s4 center"><a class="btn red">
                  <i  class="material-icons">delete</i>   Delete</div></a>
                  <div class="col s4 center"><a class="btn blue">
                    <i class="material-icons">mode_edit</i>   Edit Question</div></a>
                    <div class="col s4 center"><a class="btn pink">
                      <i class="material-icons">mode_edit</i>   Edit Option</div></a>
                    </div>
                  </li>
              </div>
            </ul> -->
            </div>
          </div>
        </div>
      </div>
      <!--=--------------------------------- Modal for edit question  ------------------------ -->

      <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>Edit Question</h4>
        <input id="modal-question">
      </div>
      <div class="modal-footer">
        <a href="#" id = "edit-modal-btn" class=" modal-action modal-close waves-effect waves-green btn-flat">EDIT</a>
      </div>
    </div>

    <!-- --------------------------------Modal for edit options ---------------------------- -->

    <div id="modal2" class="modal">
    <div class="modal-content">
      <h5 class="header">These are the old options</h5>
      <div id="old_options">
      </div>
      <h5 class="header">Enter new options just by entering</h5>
      <div class="chips chips-initial chips-placeholder" id="opt"></div>
    </div>
    <div class="modal-footer">
      <a href="#" id = "edit-options-btn" class=" modal-action modal-close waves-effect waves-green btn-flat">EDIT</a>
    </div>
    </div>

    </div>

  </body>


</html>
