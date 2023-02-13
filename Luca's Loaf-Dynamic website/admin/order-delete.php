<?php
	
	include('config.php');
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "DELETE FROM food_order WHERE id= '$id'";
		$res = mysqli_query($conn, $sql);
		if($res == true){
			$_SESSION['delete'] = "<div class='success text-center'>Order deleted successfully.</div>";
			header('location:order.php');
		}
		else{
			$_SESSION['delete'] = "<div class='error text-center'>Order deleted faild.</div>";
			header('location:order.php');
		}
	}
	else{
		header('location:admin/food.php');
	}
	
	
	
	
?>