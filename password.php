<?php

// echo $passarray[1] ;
function getpassword(){
$passarray = array('kAkm' , 'jn1KS' ,'A5Nkas' , 's8iOSo' , 'dS5S' , 'tgSoj' , 'tgd3') ;
$onep = rand(0,6);
$twop = rand(0,6) ;
$pass = $passarray[$onep] . $passarray[$twop] ;
return $pass ;
}
echo getpassword();

 ?>
