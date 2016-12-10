<?php
include('dbcon.php') ;
$query = $_POST['query'] ;
mysqli_query($conn , $query) ;
?>
