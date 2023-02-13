<?php include('header.php'); ?>
       <?php
        if(isset($_REQUEST['submit'])){
            $id = $_REQUEST['id'];
            $backTo = mysqli_real_escape_string($conn,$_REQUEST['backTo'] );
            $name = mysqli_real_escape_string($conn,$_REQUEST['name'] );
            $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
            $email = mysqli_real_escape_string($conn,$_REQUEST['email'] );
			
			$sql2 = "UPDATE admin SET
				name = '$name',
				username = '$username',
				email = '$email' WHERE id='$id'
			";
			$res2 = mysqli_query($conn, $sql2);
			if($res2 == true){
				$_SESSION['update'] = "<div class='success text-center'>update successfully.</div>";
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
				$_SESSION['update'] = "<div class='error text-center'>Failed to update.</div>";
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
        
    ?>


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">User Edit</h2>
			<div class="heading-border"></div>
            
			<?php
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$backTo = $_GET['bt'];
					$sql = "SELECT * FROM admin WHERE id=$id";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						if($count == 1){
							$row = mysqli_fetch_assoc($res);
							$name = $row['name'];
							$username = $row['username'];
							$email = $row['email'];
						}
						else{
							header('location:'.SITEURL.'admin/admin.php');
						}
					}
				}
				else{
					header('location:'.SITEURL.'admin/admin.php');
				}
			?>
			
			
            <form action="" method="POST">
                <table class="tbl-50">

                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="name" value="<?php echo $name ?>" placeholder="Enter full name..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username ?>" placeholder="Enter username..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="email" name="email" value="<?php echo $email ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id"  value="<?php echo $id; ?>">
                            <input type="hidden" name="backTo"  value="<?php echo $backTo; ?>">
                            <input type="submit" name="submit" value="Update" class="btn btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>
    

   
  
 










