<?php 
	include('header.php'); 
?>
   


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="admin-container" >
            <h2 class="text-center">Manager Panel</h2>
			<div class="heading-border"></div>
			
			<?php 
				if(isset($_SESSION['admin'])){
			?>
			<a href="admin-add.php" class="btn btn-primary admin-btn-center">Add Admin</a>
			<br />
			<?php
				}
			?>
			
			<?php 
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					echo "<br>";
					unset($_SESSION['add']);
				}
				if(isset($_SESSION['delete'])){
					echo $_SESSION['delete'];
					echo "<br>";
					unset($_SESSION['delete']);
				}
				if(isset($_SESSION['update'])){
					echo $_SESSION['update'];
					echo "<br>";
					unset($_SESSION['update']);
				}
				if(isset($_SESSION['error-current-pwd'])){
					echo $_SESSION['error-current-pwd'];
					echo "<br>";
					unset($_SESSION['error-current-pwd']);
				}
				if(isset($_SESSION['pwd-not-match'])){
					echo $_SESSION['pwd-not-match'];
					echo "<br>";
					unset($_SESSION['pwd-not-match']);
				}
				if(isset($_SESSION['change-pwd'])){
					echo $_SESSION['change-pwd'];
					echo "<br>";
					unset($_SESSION['change-pwd']);
				}
				
			?>
            
            <table class="admin-table">
               
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <!--<th colspan="2">Actions</th>-->
                    <th <?php if( isset($_SESSION['admin'])){echo "colspan='3'";}else{echo "colspan='2'";} ?>>Actions</th>
                </tr>
                
				<?php 
					$sql = "SELECT * FROM admin WHERE role='Manager' ORDER BY id DESC";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						$sn = 1;
						if($count>0){
							while($rows = mysqli_fetch_assoc($res)){
								$id = $rows['id'];
								$name = $rows['name'];
								$username = $rows['username'];
								$email = $rows['email'];
								?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $username; ?></td>
									<td>
										<?php 
											echo $email;
											if(isset($_SESSION['manager']) && $_SESSION['manager'] == $email){
												echo " <img class='active-user' src='https://img.icons8.com/fluency/48/000000/ok.png'/>";
											}
										?>
									</td>
									<td class="text-center" <?php if( isset($_SESSION['manager']) AND $_SESSION['manager'] != $email){echo "colspan='2'";} ?>>
										<?php 
											if( isset($_SESSION['admin'])){
												?>
												<a href="/admin/admin-update.php?id=<?php echo $id; ?>&&bt=ep" class="btn-warning">Edit</a>
									</td>
									<td class="text-center">
												<a href="/admin/admin-delete.php?id=<?php echo $id; ?>&&bt=ep" class="btn-danger" onclick="return confirm('Are you sure...?');">Delete</a>
									</td>
									<td class="text-center">
												<?php
											}
											else if(isset($_SESSION['manager']) AND $_SESSION['manager'] == $email){
												?>
												<a href="/admin/admin-update.php?id=<?php echo $id; ?>&&bt=ep" class="btn-warning">Edit</a>
									</td>
									<td class="text-center">
												<a href="/admin/admin-pwd-update.php?id=<?php echo $id; ?>&&bt=ep" class="btn-success">Change Password</a>
												<?php
											}
										?>
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