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
    <header class="navbar">
		<nav id="site-top-nav" class="navbar-menu navbar-fixed-top animated fadeInUpBig">
        <div class="container">
		
		<!-- Logo -->
            <div class="logo">
                <a href="admin/" title="Logo">
                    <img src="../images/logo.png" alt="Bakery Logo" class="img-responsive">
                </a>
            </div>

           <!-- Main Menu -->
            <div class="menu text-right">
                <ul>
                    <li>
                        <a class="hvr-underline-from-center" href="admin.php">Dashboard</a>
                    </li>
                    <li>
						<?php 
							$sql = "SELECT * FROM contact WHERE status='Unread' ";
							$res = mysqli_query($conn, "SELECT * FROM contact WHERE status='Unread' ");
							$message_count = mysqli_num_rows($res);
						?>
						
                        <a href="message.php">Message <?php if($message_count>0){ ?><span class="notify">(<?php echo $message_count; ?>)</span><?php } ?></a>
                    </li>
                    <li>
                        <a href="admin.php">Admin</a>
                    </li>
                    <li>
                        <a href="manager.php">Manager</a>
                    </li>
                    <li>
                        <a href="category.php">Category</a>
                    </li>
                    <li>
                        <a href="food.php">Bakery-items</a>
                    </li>
                    <li>
						<?php 
							$sql2 = "SELECT * FROM food_order WHERE status='Ordered' OR status='On Delivery' ";
							$res2 = mysqli_query($conn, $sql2);
							$order_count = mysqli_num_rows($res2);
						?>
                        <a href="order.php">Order <?php if($order_count>0){ ?><span class="notify">(<?php echo $order_count; ?>)</span><?php } ?></a>
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
                        <a href="logout.php">Logout <span class="notify">(<?php echo $username; ?>)</span></a>
                    </li>
                </ul>
            </div>
			<div class="clearfix"></div>
        </div>
		</nav>  
    </header>
    <!-- Navbar Section Ends Here -->
