<?php
$host="localhost";
$db_user="root";
$db_pass="";
$db_name="chatroom";
$timezone="America/New_York";
 
$link=mysqli_connect($host,$db_user,$db_pass);//Connect to the database host
mysqli_select_db($link,$db_name);//choose database 
mysqli_query($link,"SET names UTF8");//Set the database encoding format
 
header("Content-Type: text/html; charset=utf-8");//Set header styles
date_default_timezone_set($timezone); //new york time 

?>