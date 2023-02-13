<?php include('admin/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo SITEURL; ?>images/logo.png">
    <title>Bakery Website</title>

    <!-- Link our CSS file -->
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/hover-min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <header class="navbar">
		<nav id="site-top-nav" class="navbar-menu navbar-fixed-top animated fadeInUpBig">
        <div class="container">
		
		<!-- Logo -->
            <div class="logo">
                <a href="index.php" title="Logo">
                    <!-- <img src="images/logo.png" alt="Bakery Logo" class="img-responsive"> -->
					<img src="images/logo.png" class="img-responsive">
                </a>
            </div>

           <!-- Main Menu -->
            <div class="menu text-right">
                <ul>
                    <li>
                        <a class="hvr-underline-from-center" href="index.php">Home</a>
                    </li>
                    <li>
                        <a class="hvr-underline-from-center" href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a class="hvr-underline-from-center" href="foods.php">Bakery-Items</a>
                    </li>
                    <li>
                        <a class="hvr-underline-from-center" href="order.php">Order</a>
                    </li>
                    <li>
                        <a class="hvr-underline-from-center" href="contact.php">Contact for career</a>
                    </li>
                    <li>
                        <a class="hvr-underline-from-center" href="login.php">Login</a>
                    </li>
                    <li>
						 <a id="shopping-cart" class="shopping-cart">
							<?php 
								if(isset($_COOKIE["shopping_cart"]))
								{
									$food_count = 0;
									$cookie_data = stripslashes($_COOKIE['shopping_cart']);
									$cart_data = json_decode($cookie_data, true);
									foreach($cart_data as $keys => $values)
									{
										$food_count++;
									}
									if($food_count<=0){
										$url= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
										header("location:cart_core.php?action=clear&url=$url");
									}
								}
							?>
							<i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <?php if(isset($_COOKIE["shopping_cart"]) && $food_count>0){echo "<span class='notify'>$food_count</span>";} ?>
						 </a>
						   <div id="cart-content" class="cart-content">
								<h3 class="text-center">Shopping Cart</h3>
								<table class="cart-table" border="0">
									<tr>
										<th>Food</th>
										<th>Name</th>
										<th>Price</th>
										<th>Qty</th>
										<th>total</th>
										<th>Action</th>
									</tr>
									
									<?php
										if(isset($_COOKIE["shopping_cart"]))
										{
											$total = 0;
											$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
											$cookie_data = stripslashes($_COOKIE['shopping_cart']);
											$cart_data = json_decode($cookie_data, true);
											foreach($cart_data as $keys => $values)
											{
										?>
											<tr>
												<td>
													<img src="images/food/<?php echo $values["item_img"]; ?>" alt="" />
												</td>
												<td><?php echo $values["item_name"]; ?></td>
												<td>$ <?php echo $values["item_price"]; ?></td>
												<td><?php echo $values["item_quantity"]; ?></td>
												<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
												<td><a class="btn btn-danger" href="cart_core.php?action=delete&id=<?php echo $values["item_id"]; ?>&food=<?php echo $values["item_name"]; ?>&url=<?php echo $current_url; ?>">&times;</a></td>
												
											</tr>
										<?php	
												$total = $total + ($values["item_quantity"] * $values["item_price"]);
											}
										?>
											<tr>
												<th colspan="4">Total</th>
												<th>$ <?php echo number_format($total, 2); ?></th>
												<th></th>
											</tr>
										<?php
										}
										else
										{
											echo '
											<tr>
												<td colspan="6" align="center">No Item in Cart</td>
											</tr>
											';
										}
										?>
								</table> 
								<a href="<?php ?>order.php" class="btn btn-primary">Confirm Order</a>
							</div>
                    </li>
                </ul>
            </div>
			<div class="clearfix"></div>
        </div>
		</nav>  
    </header>
    <!-- Navbar Section Ends Here -->