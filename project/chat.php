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
			<p>Welcome to the chat room for your topic. you have chosen the following: <strong><?php echo $_SESSION['topic']; ?></strong>. </p>
	</div>
</body>
</html>