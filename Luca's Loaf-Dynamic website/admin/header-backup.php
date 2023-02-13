<?php 
	include('config.php'); 
	
	if(!isset($_SESSION['admin']) AND !isset($_SESSION['manager'])){
		$_SESSION['unauthorized']="<div class='error'>Please, login to access Admin Panel.</div>";
		header('location:'.SITEURL.'login.php');
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="images/favicon.ico">
    <title>Bakery Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL ?>admin/" title="Logo">
                    <img src="../images/logo.png" alt="Bakery Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL ?>admin/">Dashboard</a>
                    </li>
                    <li>
						<?php 
							$sql = "SELECT * FROM contact WHERE status='Unread' ";
							$res = mysqli_query($conn, $sql);
							$message_count = mysqli_num_rows($res);
						?>
						
                        <a href="<?php echo SITEURL ?>admin/message.php">Message <?php if($message_count>0){ ?><span class="notify">(<?php echo $message_count; ?>)</span><?php } ?></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ?>admin/admin.php">Admin</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ?>admin/manager.php">Manager</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ?>admin/category.php">Category</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ?>admin/food.php">Food</a>
                    </li>
                    <li>
						<?php 
							$sql2 = "SELECT * FROM food_order WHERE status='Ordered' OR status='On Delivery' ";
							$res2 = mysqli_query($conn, $sql2);
							$order_count = mysqli_num_rows($res2);
						?>
                        <a href="<?php echo SITEURL ?>admin/order.php">Order <?php if($order_count>0){ ?><span class="notify">(<?php echo $order_count; ?>)</span><?php } ?></a>
                    </li>
                    <li>
						<?php 
							if(isset($_SESSION['admin'])){
								$user_email = $_SESSION['admin'];
							}
							else if(isset($_SESSION['manager'])){
								$user_email = $_SESSION['manager'];
							}
							
							$sql3 = "SELECT * FROM admin WHERE email='$user_email'";
							$res3 = mysqli_query($conn, $sql3);
							if($res == true){
								$user_count = mysqli_num_rows($res3);
								if($user_count>0){
									while($rows = mysqli_fetch_assoc($res3)){
										$username = $rows['username'];
									}
								}
							}
							
						?>
                        <a href="admin/logout.php">Logout <span class="notify">(<?php echo $username; ?>)</span></a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->