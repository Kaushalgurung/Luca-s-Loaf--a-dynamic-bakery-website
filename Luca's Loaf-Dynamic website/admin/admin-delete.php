<?php
	
	include('config.php');
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$backTo = $_GET['bt'];
		$sql = "DELETE FROM admin WHERE id= $id";
		$res = mysqli_query($conn, $sql);
		if($res == true){
			$_SESSION['delete'] = "<div class='success text-center'>Admin deleted successfully.</div>";
			if($backTo == 'ap'){
				?>
				<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
				<?php
			}
			elseif($backTo == 'ep'){
				?>
				<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
				<?php
			}
		}
		else{
			$_SESSION['delete'] = "<div class='error text-center'>Admin deleted field.</div>";
			if($backTo == 'ap'){
				?>
				<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
				<?php
			}
			elseif($backTo == 'ep'){
				?>
				<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
				<?php
			}
		}

	}
	
	
	
?>