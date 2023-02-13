<?php
	
	include('config.php');
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "DELETE FROM contact WHERE id= '$id'";
		$res = mysqli_query($conn, $sql);
		if($res == true){
			$_SESSION['delete'] = "<div class='success text-center'>Message deleted successfully.</div>";
			header('location:message.php');
		}
		else{
			$_SESSION['delete'] = "<div class='error text-center'>Message deleted field.</div>";
			header('location:message.php');
		}
	}
	else{
		header('location:message.php');
	}
	
	
	
	
?>