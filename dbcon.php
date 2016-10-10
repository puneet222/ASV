 <?php
 $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = 'Incorrect';
   $database = 'auto_survey_voting' ;
   $conn = new mysqli($dbhost, $dbuser, $dbpass , $database);
   if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
}
?>
