<?php
include 'dbcon.php';
$fname =  $_POST["first_name"];
$lname = $_POST["last_name"];
$org = $_POST["org_name"];
$pass = $_POST["password"];
$email = $_POST["email"];
$sname = $_POST["survey_heading"];
$type = $_POST["type"];
echo $type;
if($type == "auth")
$x = 1;
else
$x = 0;
$num;
// $sql = "select survey from ids";
// // $stmt = $mysqli->prepare("INSERT INTO CountryLanguage VALUES (?, ?, ?, ?)");
// $ret = mysqli_query($conn , $sql);
// while($row = mysqli_fetch_assoc($ret)){
// 	$num = $row['survey'];
// 	echo $num;
// 	}
// 	$num = $num + 1;
// $sid = substr($org,0,3).substr($sname,0,3).substr($type,0,2).$num;
// $q = 'update ids set survey = '.$num;

echo $fname." ".$lname." ".$org." ".$pass." ".$email." ".$sname." ".$type."<BR>";


$query = "insert into survey values('".$org."','".$sid."','".$pass."','".$x."','".$sname."','".$fname."','".$lname."','".$email."');";
if($query = $mysqli->prepare("INSERT into survey VALUES (?,?,?,?,?,?,?,?)"))
{
	 $query->bind_param("sssissss",$fname , $lname , $org , $pass , $email , $sname  , $type );
	 echo "string";
	 echo $query."sfjewoifn" ;
	if( $query->execute())
	{

	}
	else
	{
		echo "insert query not executed" ;
	}
}
else
{
	echo "query not prepared" ;
}

echo $query;
mysqli_query($conn , $q);
// $test = mysql_query($query,$conn);
// if(!$test)
// {
// 	echo "fail";
// }
mysql_close($conn);
?>