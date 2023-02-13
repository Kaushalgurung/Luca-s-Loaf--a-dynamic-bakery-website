<?php 
	include('header.php');
?>
	<section class="categories">
        <div class="container">
			
            <h2 class="text-center">About Luca & Bread</h2>
			<div class="heading-border"></div>
			<h1 align:center>Luca commenced his career as a lifeguard but was laid off. He found he enjoyed making bread and
experimented and in no time at all had built up a thriving business.<br>
About sourdough bread.<br>
<li>It has no store/commercial yeast<br></li>
<li>Hand kneaded and shaped in-house<br></li>
<li>-Prepared over 14-17hrs<br></li>
<li>Organic flour, the water is filtered and the electricity used to power the oven is solar powered!<br></li>
<li>Store bought bread is mixed and baked within 2 hours meaning the gluten content is really
high and can lead to someone feeling clogged up when eating bread. Sourdough is a great
alternative and much easier to digest.</h1></li>
			
			
			

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for item.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary search-btn">
            </form>

        </div>
    </section>
    <!-- fOOD search Section Ends Here -->
		
		<?php
			if(isset($_SESSION['add_to_cart'])){
				echo $_SESSION['add_to_cart'];
				unset($_SESSION['add_to_cart']);
			}
		?>
	
    

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Bakery Menu</h2>
			<div class="heading-border"></div>
			
			<?php 
				$sql2 = "SELECT * FROM food WHERE featured='Yes' AND active='Yes' ORDER BY id DESC LIMIT 6";
				$res2 = mysqli_query($conn, $sql2);
				if($res2 == true){
					$count2 = mysqli_num_rows($res2);
					if($count2>0){
						while($rows = mysqli_fetch_assoc($res2)){
							$id = $rows['id'];
							$title = $rows['title'];
							$price = $rows['price'];
							$image = $rows['image'];
							$description = $rows['description'];
							?>
							<div class="food-menu-box">
								<form action="cart_core.php" method="POST">
									<div class="food-menu-img">
										<?php 
											if($image != ""){
											?>
											<img src="images/food/<?php echo $image; ?>" alt=""  class="img-responsive img-curve" />
											<?php
											}
											else{
												echo "<div class='error'>Image not avilable.</div>";
											}
										?>
									
									</div>

									<div class="food-menu-desc">
										<h4><?php echo $title; ?></h4>
										<p class="food-price">$<?php echo $price; ?></p>
										<p class="food-detail">
											<?php echo $description; ?>
										</p>
										<br>
										<input type="number" name="quantity" value="1" min="1"/>
										<br />
										<br />
										<input type="hidden" name="hidden_id" value="<?php echo $id; ?>" />
										<input type="hidden" name="hidden_name" value="<?php echo $title; ?>" />
										<input type="hidden" name="hidden_img" value="<?php echo $image; ?>" />
										<input type="hidden" name="hidden_price" value="<?php echo $price; ?>" />
										<input type="hidden" name="url" value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
										<!--<a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>-->
										<input type="submit" name="add_to_cart" class="btn btn-primary" value="Add to Cart" />
									</div>
								</form>
							</div>
							<?php
						}
					}
					else{
						echo "<div class='error'>Item not avilable.</div>";
					}
				}
			?>
            

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php" class="btn btn-primary">See All Items</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php
		include('footer.php');
	?>