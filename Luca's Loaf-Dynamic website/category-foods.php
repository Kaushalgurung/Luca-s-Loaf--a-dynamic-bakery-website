<?php 
	include('header.php'); 
?>
	<?php 
		if(isset($_GET['category_id'])){
			$category_id= mysqli_real_escape_string($conn, $_GET['category_id']);
			$sql = "SELECT title FROM category WHERE id='$category_id'";
			$res = mysqli_query($conn, $sql);
			$rows = mysqli_fetch_assoc($res);
			$title = $rows['title'];
		}
		else{
			header('location:'.SITEURL);
		}
	?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 style="background:#44bd32">Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

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
            <h2 class="text-center">Food Menu</h2>
			
			<?php 
				$sql2 = "SELECT * FROM food WHERE category_id='$category_id'";
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