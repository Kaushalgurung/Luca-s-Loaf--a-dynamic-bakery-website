<?php include('header.php'); ?>
   


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="admin-container" style="padding:0 10px" >
            <h2 class="text-center">Messages</h2>
			<div class="heading-border"></div>

			<?php 
				if(isset($_SESSION['delete'])){
					echo $_SESSION['delete'];
					echo "<br />";
					unset($_SESSION['delete']);
				}
			?>
            
            <table class="admin-table">
               
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th colspan="2">Actions</th>
                </tr>
                
				<?php 
					$sql = "SELECT * FROM contact ORDER BY id DESC";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						$sn = 1;
						if($count>0){
							while($rows = mysqli_fetch_assoc($res)){
								$id = $rows['id'];
								$name = $rows['name'];
								$email = $rows['email'];
								$phone = $rows['phone'];
								$subject = $rows['subject'];
								$message = $rows['message'];
								$status = $rows['status'];
								$date = $rows['date'];
								?>
								<tr <?php if($status=="Unread"){echo "class='bold'";} ?>>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $email; ?></td>
									<td><?php echo $phone; ?></td>
									<td><?php echo $subject; ?></td>
									<td><?php echo substr($message,0,20); ?>...</td>
									<td><?php echo $date; ?></td>
									<td class="text-center">
										<a href="<?php ?>message-view.php?id=<?php echo $id; ?>&status=<?php echo $status ?>" class="btn-warning">View</a>
									</td>
									<td class="text-center">
										<a href="<?php ?>message-delete.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
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