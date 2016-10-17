<?php
include('dbcon.php') ;

$res = $conn->query("Select * from ids") ;
$row = $res->fetch_assoc();
echo $row['question'];
$numq = $row['question'];
$numq = $numq + 1 ;
$numa = $row['survey'] ;
$nume = $row['extra'] ;

// now truncate the Table
$trunk = "TRUNCATE TABLE ids" ;
mysqli_query($conn, $trunk);

$stmt = $conn->prepare("INSERT INTO `ids`(`question`, `survey`, `extra`) VALUES (?, ?, ?)");
$stmt->bind_param('ddd', $numq , $numa , $nume);

/* execute prepared statement */
$stmt->execute();

printf("%d Row inserted.\n", $stmt->affected_rows);

/* close statement and connection */
$stmt->close();

?>
