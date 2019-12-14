<?php include('server.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat Room</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Chat Room</h2>
			<p>Welcome to the chat room, <strong><?php echo $_SESSION['username']; ?></strong>.</br>
			Feel free to discuss any topics with other users!</p>
	</div>


	<?php
if (isset($_GET['enSubmit']) && isset($_GET['uname']) && isset($_GET['rname'])){
	echo'<meta http-equiv="refresh" content="10">';
	$room=$_GET['rname']; 
	$uname=$_GET['uname'];
	if (!is_dir($room)) mkdir($room);
	$files = scandir($room);
	foreach ($files as $user){
		if ($user=='.' || $user=='..') continue;
		$handle=fopen("$room/$user",'r');
		$time = fread($handle, filesize("$room/$user"));
		fclose($handle);
		if ((time()-$time)>30) unlink("$room/$user");
	}
	$contents='';
	$filename="$room.txt";
	if (file_exists($filename)){
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);	
	}
	$handle = fopen("$room/$uname", "w");
	fwrite($handle, time());
	fclose($handle);
	
	$files = scandir($room);
	$users='';
	foreach ($files as $user) if ($user!='.' && $user!='..') $users.=$user."\n";
	
	if (isset($_POST['Send'])){
		$text=$_POST['txt'];
		$contents.="$uname: $text";
		$handle = fopen("$filename", "a");
		fwrite($handle, "$uname: $text\n");
		fclose($handle);
	}
?>
<body OnLoad="document.myform.txt.focus()">
<form style="width: 50%;"action="" method="post" name="myform">
<table style="width: 100%; border-style: groove;border-width: 1px;" align="center">
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 16pt;text-align: center; color: #2214B9;border-style: groove;border-width: 1px; height: 350px;">
			<textarea readonly="readonly" name="txtchat" style="color: #000000; height: 365px; background-color: #DCDCDC; font-family: 'times New Roman', Times, serif; font-size: 12pt;"><?php echo "Welcome to the $room chatroom...\n$contents"?> </textarea>
		</td>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 16pt;text-align: center;color: #2214B9;border-style: groove;border-width: 1px; height: 349px;">
			<textarea readonly="readonly"  contenteditable="false"  name="txtusers" style="; height: 365px; background-color: #DCDCDC; font-family: 'times New Roman', Times, serif; font-size: 12pt; font-weight: bold; text-align: center;"><?php echo $users?></textarea></td>
	</tr>
	<tr>
		<td style=" border-style: groove;border-width: 1px;text-align: left; height: 39px; font-size: 14pt;">
		<textarea id="txtt"  name="txt" style=" height: 79px; font-family: 'times New Roman', Times, serif; font-size: 12pt"></textarea></td>
		<td style="border-style: groove;border-width: 1px; height: 39px;padding-left: 8px; text-align: center;">
		<input name="Send" style="padding: 10px; font-size: 16pt; font-family: 'Times New Roman', Times, serif; color: white; background-color:#f24537;" type="submit" value="Send"></td>
	</tr>
</table>
</form>
 
<?php
}else {
?>
<form style="width: 50%;"method="get" action="">
<table style="width: 100%;border: 2px groove orange;" align="center">
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif; font-size: 16pt; text-align: left; color: white; width: 20%; padding: 10px; background-color: red; border-style: groove;border-width: 1px;">Nickname:</td>
		<td style="border-style: groove; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 16pt; text-align: left; color: #2214B9;">
		<input name="uname" style="font-size: 16px; color: #B01919;"></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 16pt;text-align: left; color: white; width: 20%; padding: 10px; background-color: red; border-style: groove;border-width: 1px;">Select Room:</td>
		<td style="border-style: groove; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 16pt; text-align: left; color: #2214B9;">
		<select name="rname" style=" font-size: 16px; color: #B01919;">
		<option selected="">General Chat</option>
		</select></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 16pt;text-align: center; color: #2214B9; border-style: groove; border-width: 1px; padding-top:10px;padding-bottom:10px" colspan="2">
		<input name="enSubmit" style="font-size: 16pt; font-family: 'Times New Roman', Times, serif; color: white; padding: 10px; background-color:#f24537;" type="submit" value="Enter"></td>
	</tr>
</table>
</form>
<?php
}
?>
<script>
el=document.myform.txtt
    if (typeof el.selectionStart == "number") {
        el.selectionStart = el.selectionEnd = el.value.length;
    } else if (typeof el.createTextRange != "undefined") {
        el.focus();
        var range = el.createTextRange();
        range.collapse(false);
        range.select();
    }</script>
 	<div class = "prev">
	<a href="index.php">Previous Page</a>
	</div>
</body>

</html>