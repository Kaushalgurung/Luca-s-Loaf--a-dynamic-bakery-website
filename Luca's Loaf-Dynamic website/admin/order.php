<?php include('header.php'); ?>
   


    <!-- Categories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="admin-container" style="padding:0 10px" >
            <h2 class="text-center">Order</h2>
			<div class="heading-border"></div>
			
			<?php 
				if(isset($_SESSION['delete'])){
					echo $_SESSION['delete'];
					echo "<br />";
					unset($_SESSION['delete']);
				}
				if(isset($_SESSION['update'])){
					echo $_SESSION['update'];
					echo "<br />";
					unset($_SESSION['update']);
				}
			?>
			
            
            <table class="admin-table">
               
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th colspan="2">Actions</th>
                </tr>
                
				<?php 
					$sql = "SELECT * FROM food_order ORDER BY id DESC";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						$sn = 1;
						if($count>0){
							while($rows = mysqli_fetch_assoc($res)){
								$id = $rows['id'];
								$title = $rows['title'];
								$price = $rows['price'];
								$qty = $rows['qty'];
								$total = $rows['total'];
								$order_date = $rows['order_date'];
								$status = $rows['status'];
								$customer_name = $rows['customer_name'];
								$customer_contact = $rows['customer_contact'];
								$customer_email = $rows['customer_email'];
								$customer_address = $rows['customer_address'];
								?>
								<tr <?php if($status == "Ordered" OR $status=="On Delivery"){echo "class='bold'";} ?>>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $price; ?></td>
									<td><?php echo $qty; ?></td>
									<td><?php echo $total; ?></td>
									<td><?php echo $order_date; ?></td>
									<td>
										<?php
											if($status=="Ordered"){
												echo "<label>Ordered</label>";
											}
											else if($status=="On Delivery"){
												echo "<label class='btn-warning'>On Delivery</label>";
											}
											else if($status=="Delivered"){
												echo "<label class='btn-success'>Delivered</label>";
											}
											else if($status=="Cancelled"){
												echo "<label class='btn-danger'>Cancelled</label>";
											}
										?>
									</td>
									<td><?php echo $customer_name; ?></td>
									<td><?php echo $customer_contact; ?></td>
									<td><?php echo $customer_email; ?></td>
									<td><?php echo $customer_address; ?></td>
									<td class="text-center">
										<a href="<?php ?>order-update.php?id=<?php echo $id; ?>" class="btn-warning">Update</a>
									</td class="text-center">
									<td>
										<a href="<?php ?>order-delete.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure...?');">Delete</a>
									</td>
								</tr>
								<?php
							}
						}
					}
				?>

            </table>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>