<?php
include_once("connect.php");//connect data base 
 
$q=mysqli_query($link,"select * from comments");//get data from data  base 
while($row=mysqli_fetch_array($q)){
		$comments[] = array("id"=>$row['id'],"user"=>$row['user'],"comment"=>$row['comment'],"addtime"=>$row['addtime']);
}
echo json_encode($comments);//Encoded in json format
?>