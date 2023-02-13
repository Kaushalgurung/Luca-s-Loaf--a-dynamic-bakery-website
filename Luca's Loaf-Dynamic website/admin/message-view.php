<?php include('header.php'); ?>
   


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">View Message</h2>
			<div class="heading-border"></div>
            
			<?php
				if(isset($_GET['id']) AND isset($_GET['status'])){
					$status = mysqli_real_escape_string($conn, $_GET['status']);
					$id = mysqli_real_escape_string($conn, $_GET['id']);
					if($status == "Unread"){
						$sql = "UPDATE `contact` SET 
						`status`='Read' WHERE id='$id'";
						$res = mysqli_query($conn, $sql);
					}
					$sql2 = "SELECT * FROM contact WHERE id='$id'";
					$res2 = mysqli_query($conn, $sql2);
					if($res2 == true){
						$count = mysqli_num_rows($res2);
						if($count == 1){
							$row = mysqli_fetch_assoc($res2);
							$name = $row['name'];
							$email = $row['email'];
							$phone = $row['phone'];
							$subject = $row['subject'];
							$date = $row['date'];
							$message = $row['message'];
						}
						else{
							header('location:'.SITEURL.'admin/contact.php');
						}
					}
				}
				else{
					header('location:'.SITEURL.'admin/contact.php');
				}
				
			?>
			
			
            <form action="" method="POST">
                <table class="tbl-50">

                    <tr>
                        <td>Name</td>
                        <td>
                            <p><?php echo $name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <p><b><?php echo $email; ?></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <p><?php echo $phone; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>
                            <p><?php echo $subject; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>
                            <p><?php echo $date; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>
                            <p><?php echo $message; ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td>
							<a href="<?php echo SITEURL; ?>/admin/message-delete.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure...?');">Delete</a>
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
				<script><?php echo("location.href = '".SITEURL."admin/order.php';");?></script>
				<?php
				
			}
			else{
				$_SESSION['update'] = "<div class='error text-center'>Failed to update status.</div>";
				?>
				<script><?php echo("location.href = '".SITEURL."admin/order.php';");?></script>
				<?php
			}

			
        }
        
    ?>
   
  
 










