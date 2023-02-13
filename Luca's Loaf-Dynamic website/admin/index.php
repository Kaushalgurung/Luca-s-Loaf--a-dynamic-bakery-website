<?php include('header.php'); ?>
   


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Dashboard</h2>
			<div class="heading-border"></div>
			
			<?php 
				if(isset($_SESSION['login_true'])){
					echo $_SESSION['login_true'];
					echo "<br /><br />";
					unset($_SESSION['login_true']);
				}
			?>
			

			<a href="category.php">
				<div class="col-4 text-center">
					
					<?php 
						$sql = "SELECT * FROM category";
						$res = mysqli_query($conn, $sql);
						$category_count = mysqli_num_rows($res);
					?>
				
					<h1><?php echo $category_count; ?></h1>
					<br>
					Category
				</div>
			</a>
			<a href="food.php">
				<div class="col-4 text-center">
				
					<?php 
						$sql2 = "SELECT * FROM food";
						$res2 = mysqli_query($conn, $sql2);
						$food_count = mysqli_num_rows($res2);
					?>
					
					<h1><?php echo $food_count; ?></h1>
					<br>
					Foods
				</div>
			</a>
			<a href="order.php">
				<div class="col-4 text-center">
					
					<?php 
						$sql3 = "SELECT * FROM food_order";
						$res3 = mysqli_query($conn, $sql3);
						$order_count = mysqli_num_rows($res3);
					?>
				
					<h1><?php echo $order_count; ?></h1>
					<br>
					Total Orders
				</div>
			</a>
			<a href="#">
				<div class="col-4 text-center">
					
					<?php 
						$sql4 = "SELECT SUM(total) AS Total FROM food_order WHERE status='Delivered'";
						$res4 = mysqli_query($conn, $sql4);
						$rows4 = mysqli_fetch_assoc($res4);
						$total_revenue = $rows4['Total'];
					?>
					
					<h1>$ 
					<?php  
						if($total_revenue<=0){
							echo "0.00";
						} 
						else{
							echo $total_revenue;
						}
					?>
					</h1>
					<br>
					Revenue Generated
				</div>
			</a>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>