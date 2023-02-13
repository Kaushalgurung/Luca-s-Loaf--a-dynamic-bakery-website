<?php 
	
	//Start Session
	session_start();
	
	//Connection
	define('SITEURL', 'http://localhost/food/');
	define('LOCALHOST', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'food');
	$conn = mysqli_connect('localhost','root','', 'food') or die(mysqli_error());
	$db_select = mysqli_select_db($conn,DATABASE) or die(mysqli_error());
?>