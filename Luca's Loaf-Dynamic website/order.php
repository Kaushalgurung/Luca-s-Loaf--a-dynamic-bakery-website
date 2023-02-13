<?php
	ob_start();
	include('header.php'); 
	
?>

<?php
	if(isset($_REQUEST['submit'])){
		$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$contact = mysqli_real_escape_string($conn, $_REQUEST['contact']);
		$email = mysqli_real_escape_string($conn,$_REQUEST['email'] );
		$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
		$time= mysqli_real_escape_string($conn, $_REQUEST['time']);
		date_default_timezone_set('Asia/KTM');
		$order_date = date("Y-m-d h:i:sa");
		$status = mysqli_real_escape_string($conn, "Ordered");
		
		
		if(isset($_COOKIE["shopping_cart"]))
		{
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_data = json_decode($cookie_data, true);
			foreach($cart_data as $keys => $values)
			{
				$total = 0;
				$title = mysqli_real_escape_string($conn, $values["item_name"]);
				$price = mysqli_real_escape_string($conn, $values["item_price"]);
				$qty = mysqli_real_escape_string($conn, $values["item_quantity"]);
				$total = $price * $qty;
				$sql = "INSERT INTO food_order SET
					title = '$title',
					price = $price,
					qty = $qty,
					total = $total,
					order_date = '$order_date',
					status = '$status',
					customer_name = '$name',
					customer_contact = '$contact',
					customer_email = '$email',
					customer_address = '$address'
				";
				$res = mysqli_query($conn, $sql);
			}
			if($res ==  true){
				setcookie("shopping_cart", "", time() - 3600);
				$url= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				
				header("location:cart_core.php?action=order_success&url=$url");
			}
			else{
				$_SESSION['order'] = "<div class='error text-center'>Faild to ordered food.</div>";
			}
		}
		else{
			$_SESSION['order'] = "<div class='error text-center'>You didn't any food.</div>";
		}
	}
?>

    <!-- FOOD SEARCH Section Starts Here -->
    <section class="order">
        <div class="container">
            
            <h2 class="text-center">Fill this form to confirm your order.</h2>
			
			<?php
				if(isset($_SESSION['order'])){
					echo $_SESSION['order'];
					unset($_SESSION['order']);
				}
				if(isset($_SESSION['add_to_cart'])){
					echo $_SESSION['add_to_cart'];
					unset($_SESSION['add_to_cart']);
				}
				
			?>
			
			<table class="tbl-full" border="0">
				<tr>
					<th>S.N.</th>
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
						$i=1;
						$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						$cookie_data = stripslashes($_COOKIE['shopping_cart']);
						$cart_data = json_decode($cookie_data, true);
						foreach($cart_data as $keys => $values)
						{
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<img src="images/food/<?php echo $values["item_img"]; ?>" alt="" />
							</td>
							<td><?php echo $values["item_name"]; ?></td>
							<td>$ <?php echo $values["item_price"]; ?></td>
							<td><?php echo $values["item_quantity"]; ?></td>
							<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
							<td><a class="btn btn-danger" href="cart_core.php?action=delete&id=<?php echo $values["item_id"]; ?>&food=<?php echo $values["item_name"]; ?>&url=<?php echo $url; ?>">&times;</a></td>
							
						</tr>
					<?php	
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
						<tr>
							<th colspan="5">Total</th>
							<th>$ <?php echo number_format($total, 2); ?></th>
							<th></th>
						</tr>
					<?php
					}
					else
					{
						echo '
						<tr>
							<td colspan="7" align="center">No Item in Cart</td>
						</tr>
						';
					}
					?>
				
				
			</table>
			
            <form action="" method="POST" class="order-form">
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="name" placeholder="Enter your name..." class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Eneter your phone..." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter your email..." class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="Enter your address..." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
			
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php 
	include('footer.php');
	ob_flush();
?>