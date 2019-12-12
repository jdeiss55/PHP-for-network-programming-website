<?php
session_start();
$username = "";
$email = "";
$errors = array();

//connect to database
$db = mysqli_connect('localhost', 'root', '', 'registration');

//if register clicked
if(isset($_POST['register'])){
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);
	//check fields
	if(empty($username)) {
		array_push($errors, "Username is required");
	}
	if(empty($password)) {
		array_push($errors, "Password is required");
	}
	if ($password != $confirm_password){
		array_push($errors, "The two passwords do not match");
	}
	//no errors save user
	if(count($errors) == 0){
		$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
		mysqli_query($db, $sql);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "Successfully logged in";
		header('location: index.php'); //home page
	}
}

//log in from login page
if(isset($_POST['login'])){
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	if(empty($username)) {
		array_push($errors, "Username is required");
	}
	if(empty($password)) {
		array_push($errors, "Password is required");
	}

	if(count($errors) == 0){
		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 1){
			//login
			$_SESSION['username'] = $username;
 			$_SESSION['success'] = "Successfully logged in";
			header('location: index.php');

		}
		else{
			array_push($errors, "Incorrect username/password");
		}
	}
}
//log out
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header('location: login.php');
}

//insert topics
if(isset($_POST['index'])){
	$topic = mysqli_real_escape_string($db, $_POST['topic']);
	if(empty($topic)) {
		array_push($errors, "Please enter a topic");
	}
	if(count($errors) == 0){
		$query = "UPDATE users SET search = '$topic'";
	}
	mysqli_query($db, $sql);
}

?>