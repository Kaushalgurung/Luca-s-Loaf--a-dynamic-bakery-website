<?php
	
	include('config.php');
	
	if(isset($_GET['id']) AND isset($_GET['image'])){
		$id = $_GET['id'];
		$image = $_GET['image'];
		if($image != ""){
			$path = "../images/category/".$image;
			$remove = unlink($path);
			if($remove == false){
				$_SESSION['remove'] = "<div class='error text-center'>Field to remove category image.</div>";
				header('location:category.php');
				die();
			}
		}
		
		$sql = "DELETE FROM category WHERE id= $id";
		$res = mysqli_query($conn, $sql);
		if($res == true){
			$_SESSION['delete'] = "<div class='success text-center'>Category deleted successfully.</div>";
			header('location:category.php');
		}
		else{
			$_SESSION['delete'] = "<div class='error text-center'>Category deleted field.</div>";
			header('location:category.php');
		}
		
	}
	else{
		header('location:category.php');
	}
	
	
	
	
?>