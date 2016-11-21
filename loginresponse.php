<?php
$email = $_POST['email'] ;
$pass = $_POST['pass'] ;

// echo $email ;
// echo $pass ;

include("dbcon.php") ;

$query = "SELECT `survey_id`, `user_pass`, `email_id`, `filled` FROM `auth_table` WHERE email_id = ". "'". $email. "'" . " AND user_pass = " . "'" . $pass . "'" .";";
// echo $query ;
$result = $conn->query($query);

if($result->num_rows > 0)
{
	echo 1 ;
}
else {
  echo 0 ;
}

?>
