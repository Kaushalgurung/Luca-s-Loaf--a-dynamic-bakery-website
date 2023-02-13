<?php include('header.php'); ?>
   
       <?php
        if(isset($_REQUEST['submit'])){
            $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
            $password = md5($_REQUEST['password']);
			
			$sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
			$res = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($res);
			if($count == 1){
				while($rows = mysqli_fetch_assoc($res)){
					$role = $rows['role'];
				}
				if($role=="Admin"){
					$_SESSION['login_true'] = "<div class='success'>Login successful.</div>";
					$_SESSION['admin'] = $email;
					?>
						<script><?php echo ("location.href = 'admin/';");?></script>
					<?php
				}
				else if($role=="Manager"){
					$_SESSION['login_true'] = "<div class='success'>Login successful.</div>";
					$_SESSION['manager'] = $email;
					?>
						<script><?php echo ("location.href = '".SITEURL."admin/';");?></script>
					<?php
				}
			}
			else{
				$_SESSION['login_false'] = "<div class='error'>Email or Password didn't match.</div>";
				?>
					<script><?php echo ("location.href = ".SITEURL."login.php");?></script>
				<?php
			}
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="login">
        <div class="container" >
            <h2 class="text-center">Login</h2>
			<div class="heading-border"></div>
			
			<?php 
				if(isset($_SESSION['login_false'])){
					echo $_SESSION['login_false'];
					unset($_SESSION['login_false']);
				}
				if(isset($_SESSION['unauthorized'])){
					echo $_SESSION['unauthorized'];
					unset($_SESSION['unauthorized']);
				}
			?>
			

			
			<br />
            
			<?php
				if( isset($_SESSION['manager'])==false && isset($_SESSION['admin'])==false ){
					?>
					<form action="" method="POST">
						<table class="tbl-30 login-tbl-35 login-form">

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
								<td></td>
								<td>
									<input type="submit" name="submit" value="Login" class="btn-secondary">
								</td>
							</tr>

						</table>
					</form>
					<?php
				}
				else{
					?>
					<p class="success">You are already logged in.</p>
					<br />
					<p class="text-center">Go to <a href="admin/index.php" class="btn-primary">Dashboard</a> ?</p>
					
					
					<?php
				}
			?>
			
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>
 










