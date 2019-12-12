<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Log in</h2>
	</div>
	<form method="post" action="login.php">
		<!--errors-->
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" name="login" class= "btn">Log in
			</button>
		</div>
		<p>
			Not a member yet? <a href="register.php"> Register</a>
		</p>
	</form>
</body>
</html>
