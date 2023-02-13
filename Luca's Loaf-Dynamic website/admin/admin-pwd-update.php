<?php include('header.php'); ?>
   <?php
        if(isset($_REQUEST['submit'])){
            $id = $_REQUEST['id'];
            $backTo = mysqli_real_escape_string($conn,$_REQUEST['backTo']);
            $current_pwd = md5($_REQUEST['current-pwd']);
            $new_pwd = md5($_REQUEST['new-pwd']);
            $con_pwd = md5($_REQUEST['con-pwd']);
			
			$sql = "SELECT * FROM admin WHERE id =$id AND password = '$current_pwd'";
			$res = mysqli_query($conn, $sql);
			if($res == true){
				$count = mysqli_num_rows($res);
				if($count == 1){
					if($new_pwd == $con_pwd){
						$sql2 = "UPDATE admin SET password='$new_pwd' WHERE id=$id";
						$res2 = mysqli_query($conn, $sql2);
						if($res2 == true){
							$_SESSION['change-pwd'] = "<div class='success text-center'>Password change successfully.</div>";
							if($backTo == 'ap'){
								?>
								<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
								<?php
							}
							elseif($backTo == 'ep'){
								?>
								<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
								<?php
							}
						}
						else{
							$_SESSION['change-pwd'] = "<div class='error text-center'>Faild to change password.</div>";
							if($backTo == 'ap'){
								?>
								<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
								<?php
							}
							elseif($backTo == 'ep'){
								?>
								<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
								<?php
							}
						}
					}
					else{
						$_SESSION['pwd-not-match'] = "<div class='error text-center'>Password doesn't match.</div>";
						if($backTo == 'ap'){
							?>
							<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
							<?php
						}
						elseif($backTo == 'ep'){
							?>
							<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
							<?php
						}
					}
				}
				else{
					$_SESSION['error-current-pwd'] = "<div class='error text-center'>Invalid current password.</div>";
					if($backTo == 'ap'){
						?>
						<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
						<?php
					}
					elseif($backTo == 'ep'){
						?>
						<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
						<?php
					}
				}
				
			}

			
        }
        
    ?>


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Update Password</h2>
            <div class="heading-border"></div>
			<?php 
				if(isset($_GET['id'])){
					$id = $_GET['id'];	
					$backTo = $_GET['bt'];
				}
				
			?>
			
			
            <form action="" method="POST">
                <table class="tbl-50">

                    <tr>
                        <td>Current password:</td>
                        <td>
                            <input type="password" name="current-pwd" placeholder="Enter current password..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>New password:</td>
                        <td>
                            <input type="password" name="new-pwd" placeholder="Enter new password..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm password:</td>
                        <td>
                            <input type="password" name="con-pwd" placeholder="Enter confirm password..." required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id"  value="<?php echo $id; ?>">
                            <input type="hidden" name="backTo"  value="<?php echo $backTo; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>
    
    
   
  
 










