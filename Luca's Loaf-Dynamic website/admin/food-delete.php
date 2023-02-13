<?php
	
	include('config.php');
	
	if(isset($_GET['id']) AND isset($_GET['image'])){
		$id = $_GET['id'];
		$image = $_GET['image'];
		if($image != ""){
			$path = "../images/food/".$image;
			$remove = unlink($path);
			if($remove == false){
				$_SESSION['remove'] = "<div class='error text-center'>Field to remove food image.</div>";
				header('location:food.php');
				die();
			}
		}
		
		$sql = "DELETE FROM food WHERE id= $id";
		$res = mysqli_query($conn, $sql);
		if($res == true){
			$_SESSION['delete'] = "<div class='success text-center'>Food deleted successfully.</div>";
			header('location:food.php');
		}
		else{
			$_SESSION['delete'] = "<div class='error text-center'>Food deleted field.</div>";
			header('location:food.php');
		}
		
	}
	else{
		header('location:food.php');
	}	
	
	
	
?>