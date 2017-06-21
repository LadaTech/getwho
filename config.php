<?php 
if($conn = mysql_connect($server= "localhost", $username ="getwhois_data"))
{
    mysql_select_db("getwhois_data",$conn);
}else{
    $conn = mysql_connect("localhost","root","");
    mysql_select_db("getwhois",$conn);
}

?>
