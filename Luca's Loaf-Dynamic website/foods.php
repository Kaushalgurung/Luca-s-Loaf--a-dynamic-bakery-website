<?php 
	include('header.php'); 
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary search-btn">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
	
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
				$sql = "SELECT * FROM food WHERE featured='Yes' AND active='Yes' ORDER BY id DESC";
				$res = mysqli_query($conn, $sql);
				if($res == true){
					$count = mysqli_num_rows($res);
					if($count>0){
						while($rows = mysqli_fetch_assoc($res)){
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
										<!--<a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>-->
										<input type="submit" name="add_to_cart" class="btn btn-primary" value="Add to Cart" />
									</div>
								</form>
							</div>
							<?php
						}
					}
					else{
						echo "<div class='error'>Food not avilable.</div>";
					}
				}
			?>
			
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php 
	include('footer.php'); 
?>