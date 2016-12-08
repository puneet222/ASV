<?php
include 'dbcon.php';

$fname =  $_POST["first_name"];
$lname = $_POST["last_name"];
$org = $_POST["org_name"];
$pass = $_POST["password"];
$sname = $_POST["survey_heading"];
$type = $_POST["type"];
$sid = substr($org,0,3).substr($sname,0,3);
$email = $_POST['email'];
if($type == "auth")
$x = 1;
else
$x = 0;
$num = 0;
echo $fname." ".$lname." ".$org." ".$pass." ".$email." ".$sname." ".$type."<BR>";
$query = "INSERT INTO `auto_survey_voting`.`survey` (`organisation`, `survey_id`, `survey_password`, `auth`, `survey_heading`, `first_name`, `last_name`, `email_id` , `start`) VALUES (?,?,?,?,?, ?, ?, ?,?)";
$select = "select survey from ids";
$result = $conn->query($select);

function getpassword(){
$passarray = array('kAkm' , 'jn1KS' ,'A5Nkas' , 's8iOSo' , 'dS5S' , 'tgSoj' , 'tgd3') ;
$onep = rand(0,6);
$twop = rand(0,6) ;
$pass = $passarray[$onep] . $passarray[$twop] ;
return $pass ;
}
$fn;$ln;$userpass = 'password';$em;$filled = 'N';

while($row = $result->fetch_assoc())
$num = $row['survey'];
$sid = $sid.($num+1);
$update = 'update ids set survey = ?';
$stt = $conn->prepare($update);
$num = $num+1;
$stt->bind_param('s',$num);
$stt->execute();
$stmt = $conn->prepare($query);
$start = 0 ;
$stmt->bind_param('sssissssi',$org,$sid,$pass,$x,$sname,$fname,$lname,$email,$start);
$stmt->execute();
$insert = "INSERT INTO `auto_survey_voting`.`auth_table` (`survey_id`, `user_pass`, `email_id`, `filled`, `first_name`, `last_name`) VALUES (?, ?, ?, ?, ?, ?);";
if($x == 1)
{

if (($handle = fopen($_FILES["a"]["tmp_name"], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ","))) {
        $numm = count($data);
        $fn = $data[0];
        $ln = $data[1];
        $em = $data[2];
    	if($aa = $conn->prepare($insert))
    		echo "true";
    	else
    		echo "false";
    	echo $fn.$ln.$em.$sid.$userpass.$filled."<BR>";
      $userpass = getpassword() ;
    	$aa->bind_param('ssssss',$sid,$userpass,$em,$filled,$fn,$ln);
    	//$aa->bind_param('ssssss',$sid,$sid,$sid,$sid,$sid,$sid);
    	$aa->execute();
    }
    fclose($handle);
}
}
else
;


function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
Redirect("takesurvey.php");
?>
