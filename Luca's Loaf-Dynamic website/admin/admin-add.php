<?php include('header.php'); ?>
   
<?php
        if(isset($_REQUEST['submit'])){
            $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
            $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
            $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
            $password = md5($_REQUEST['password']);
            $com_pwd = md5($_REQUEST['con-pwd']);
            $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
			
			$check_user = "SELECT * FROM admin WHERE email = '$email'";
			$check_user_res = mysqli_query($conn, $check_user);
			if($check_user_res == true){
				$count = mysqli_num_rows($check_user_res);
				if($count>0){
					$_SESSION['add'] = "<div class='error text-center'>This email already registered.</div>";
					if($role == 'Admin'){
						?>
						<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
						<?php
					}
					elseif($role == 'Manager'){
						?>
						<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
						<?php
					}
				}
				else{
					$sql = "INSERT INTO admin SET
						name = '$name',
						username = '$username',
						email = '$email',
						password = '$password',
						role = '$role'
					";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$_SESSION['add'] = "<div class='success text-center'>Admin added successfully.</div>";
						if($role == 'Admin'){
							?>
							<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
							<?php
						}
						elseif($role == 'Manager'){
							?>
							<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
							<?php
						}
						
					}
					else{
						$_SESSION['add'] = "<div class='error text-center'>Failed to add admin.</div>";
						if($role == 'Admin'){
							?>
							<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
							<?php
						}
						elseif($role == 'Manager'){
							?>
							<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
							<?php
						}
					}					
				}
			}
			else{
				$_SESSION['add'] = "<div class='error text-center'>Failed to add admin.</div>";
				if($role == 'Admin'){
					?>
					<script><?php echo("location.href = '".SITEURL."admin/admin.php';");?></script>
					<?php
				}
				elseif($role == 'Manager'){
					?>
					<script><?php echo("location.href = '".SITEURL."admin/manager.php';");?></script>
					<?php
				}
			}
			
			die();
			
			
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Add Admin</h2>
			<div class="heading-border"></div>
            
            <form action="" method="POST">
                <table class="tbl-50">

                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="name" placeholder="Enter full name..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" placeholder="Enter username..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Email..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Enter password..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Con-password:</td>
                        <td>
                            <input type="password" name="con-pwd" placeholder="Enter confirm password..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Position:</td>
                        <td>
                            <select name="role" id="">
								<option value="Manager">Manager</option>
								<option value="Admin">Admin</option>
							</select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Add Admin" class="btn btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>
    
    
   
  
 










