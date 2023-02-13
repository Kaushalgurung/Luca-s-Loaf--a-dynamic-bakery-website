<?php include('header.php'); ?>
   


    <!-- Categories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Add food</h2>
			<div class="heading-border"></div>
			
			<?php 
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					echo "<br>";
					unset($_SESSION['add']);
				}
				if(isset($_SESSION['upload'])){
					echo $_SESSION['upload'];
					echo "<br>";
					unset($_SESSION['upload']);
				}
			?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-50">

                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Enter title..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="text" name="price" placeholder="Enter price..." required>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
							<textarea name="description" cols="30" rows="10" placeholder="Enter description..." required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
								
								<?php 
									$sql="SELECT * FROM category WHERE active='Yes'";
									$res = mysqli_query($conn, $sql);
									$count = mysqli_num_rows($res);
									if($count>0){
										while($row = mysqli_fetch_assoc($res)){
											$id = $row['id'];
											$title = $row['title'];
											?>
											<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
											<?php
										}
									}
									else{
										?>
										<option value="0">No category found.</option>
										<?php
									}
								?>
							
							</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> NO
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> NO
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Add Food" class="btn btn-secondary">
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
			$title = mysqli_real_escape_string($conn, $_REQUEST['title']);
			$price = mysqli_real_escape_string($conn, $_REQUEST['price']);
			$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
			$category = mysqli_real_escape_string($conn, $_REQUEST['category']);
			
			if(isset($_REQUEST['featured'])){
				$featured = mysqli_real_escape_string($conn, $_REQUEST['featured']);
			}
			else{
				$featured = "No";
			}
			if(isset($_REQUEST['active'])){
				$active = mysqli_real_escape_string($conn, $_REQUEST['active']);
			}
			else{
				$active = "No";
			}
			if(isset($_FILES['image']['name'])){
				$image = $_FILES['image']['name'];
				
				if($image != ""){
					$file_string = explode(".",$image);
					$ext = end($file_string);
					$image = "food-name-".rand(0000,9999).'.'.$ext;
					
					$source_path = $_FILES['image']['tmp_name'];
					$destination_path = "../images/food/".$image;
					// Upload image
					$upload = move_uploaded_file($source_path, $destination_path);
					if($upload ==  false){
						$_SESSION['upload'] = "<div class='error text-center'>Field to upload food.</div>";
						header('location:admin/food-add.php');
						die();
					}
				}
			}
			else{
				$image="";
			}
			$sql2 = "INSERT INTO food SET
				title = '$title',
				price = '$price',
				image = '$image',
				description = '$description',
				category_id = '$category',
				featured = '$featured',
				active = '$active'
			";
			$res2 = mysqli_query($conn, $sql2);
			if($res2 == true){
				$_SESSION['add'] = "<div class='success text-center'>Food added successfully.</div>";
				//header('location:'.SITEURL.'admin/food.php');
				?>
					<script><?php echo('location:admin/food.php');?></script>
				<?php
			}
			else{
				$_SESSION['add'] = "<div class='error text-center'>Failed to add food.</div>";
				//header('location:'.SITEURL.'admin/food-add.php');
				?>
					<script><?php echo('location:admin/food-add.php');?></script>
				<?php
			}
		}
	?>
  
 

