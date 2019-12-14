<?php include('server.php');
//login block
if(empty($_SESSION['username'])) {
	header('location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div style="width: 50%;" class="content">
		<?php if (isset($_SESSION['success'])): ?>
			<div class="error success">
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<?php if (isset($_SESSION["username"])): ?>
			<p>Welcome to the website, <strong><?php echo $_SESSION['username']; ?></strong>. Please enter a topic to use our search engine!</p>
			<p><a href = "index.php?logout='1'" style="color: red;">Logout</a></p>
		<?php endif ?>
	</div>
	<div class="search" style="width: 50%;">
   		<form method="get" action="http://news.google.com/search" target = "_blank">
   		<input style = "width: 50%;" type="text" name = "q" class="searchTerm" placeholder = "Input a general topic...">
        	<button type="submit" class="searchButton" name = "button">
      		Search
     		</button>
     	</form>
     	<p style = "margin-top: 5px; text-align: center; font-size: 10px; color : #00BFFF; font-style: italic;">Examples: Sports, Food, Nature, Politics, ect.</p>
     </div>
     <button type="submit" class="chatButton" onclick = "location.href = 'chat.php'">
     	CLICK HERE TO GO TO THE CHAT ROOM!
     </button>
</body>
</html>
