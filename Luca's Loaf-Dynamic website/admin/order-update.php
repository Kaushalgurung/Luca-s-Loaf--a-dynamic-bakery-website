<?php include('header.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Update Order</h2>
			<div class="heading-border"></div>

			<?php
				if(isset($_GET['id'])){
					$id = mysqli_real_escape_string($conn, $_GET['id']);
					$sql = "SELECT * FROM food_order WHERE id='$id'";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						if($count == 1){
							$row = mysqli_fetch_assoc($res);
							$title = $row['title'];
							$price = $row['price'];
							$qty = $row['qty'];
							$total = $row['total'];
							$order_date = $row['order_date'];
							$status = $row['status'];
							$name = $row['customer_name'];
							$contact = $row['customer_contact'];
							$email = $row['customer_email'];
							$address = $row['customer_address'];
						}
						else{
							header('location:'.SITEURL.'admin/order.php');
						}
					}
				}
				else{
					header('location:'.SITEURL.'admin/order.php');
				}
				
			?>
			
			
            <form action="" method="POST">
                <table class="tbl-50">

                    <tr>
                        <td>Title</td>
                        <td>
                            <p><?php echo $title; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <p><b>$ <?php echo $price; ?></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td>
                            <p><b><?php echo $qty; ?></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>
                            <p><b>$ <?php echo $total; ?></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td>
                            <p><?php echo $order_date; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
								<option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
								<option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
								<option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Deliverd</option>
								<option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
							</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>
                            <p><?php echo $name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td>
                            <p><?php echo $contact; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <p><?php echo $email; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <p><?php echo $address; ?></p>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id"  value="<?php echo $id ?>" class="btn-secondary">
                            <input type="submit" name="submit" value="Update Status" class="btn btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>
    
    <?php
        if(isset($_REQUEST['submit'])){
            $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
            $status = mysqli_real_escape_string($conn, $_REQUEST['status']);
			
			$sql2 = "UPDATE food_order SET status = '$status' WHERE id='$id' ";
			$res2 = mysqli_query($conn, $sql2);
			if($res2 == true){
				$_SESSION['update'] = "<div class='success text-center'>Status updated as <b>$status</b>.</div>";
				?>
				<script><?php echo("href:admin/order.php");?></script>
				<?php
			}
			else{
				$_SESSION['update'] = "<div class='error text-center'>Failed to update status.</div>";
				?>
				<script>href="<?php ?>admin/order.php'"</script>
				<?php
			}
        }
    ?>
   
  




