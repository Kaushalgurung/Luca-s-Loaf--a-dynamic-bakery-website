<?php include('header.php'); ?>
   


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Update Food</h2>
			<div class="heading-border"></div>
			
			<?php
				if(isset($_SESSION['upload'])){
					echo $_SESSION['upload'];
					echo "<br>";
					unset($_SESSION['upload']);
				}
				if(isset($_SESSION['remove'])){
					echo $_SESSION['remove'];
					echo "<br>";
					unset($_SESSION['remove']);
				}
				if(isset($_SESSION['update'])){
					echo $_SESSION['update'];
					echo "<br>";
					unset($_SESSION['update']);
				}
			?>
            
			<?php
				if(isset($_GET['id'])){
					$id = mysqli_real_escape_string($conn, $_GET['id']);
					$sql = "SELECT * FROM food WHERE id='$id'";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						if($count == 1){
							$row = mysqli_fetch_assoc($res);
							$title = $row['title'];
							$price = $row['price'];
							$current_image = $row['image'];
							$description = $row['description'];
							$current_category = $row['category_id'];
							$featured = $row['featured'];
							$active = $row['active'];
						}
						else{
							header('location:'.SITEURL.'admin/food.php');
						}
					}
				}
				else{
					header('location:'.SITEURL.'admin/food.php');
				}
				
			?>
			
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-50">

                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="text" name="price" value="<?php echo $price; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload Image:</td>
                        <td>
							<?php 
								if($current_image != ""){
								?>
								<img src="images/food/<?php echo $current_image; ?>" alt="" width="70px" />
								<?php
								}
								else{
									echo "<div class='error'>Image not added.</div>";
								}
							?>
                            <input type="file" name="new_image">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
							<textarea name="description" cols="30" rows="10" required><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
								
								<?php 
									$sql2="SELECT * FROM category WHERE active='Yes'";
									$res2 = mysqli_query($conn, $sql2);
									$count2 = mysqli_num_rows($res2);
									if($count2>0){
										while($row = mysqli_fetch_assoc($res2)){
											$category_id = $row['id'];
											$category_title = $row['title'];
											?>
											<option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
                            <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> NO
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> NO
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>" />
                            <input type="submit" name="submit" value="Update Food" class="btn btn-secondary">
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
			$current_image = mysqli_real_escape_string($conn, $_REQUEST['current_image']);
			$title = mysqli_real_escape_string($conn, $_REQUEST['title']);
			$price = mysqli_real_escape_string($conn, $_REQUEST['price']);
			$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
			$category = mysqli_real_escape_string($conn, $_REQUEST['category']);
			$featured = mysqli_real_escape_string($conn, $_REQUEST['featured']);
			$active = mysqli_real_escape_string($conn, $_REQUEST['active']);
			$new_image = $_FILES['new_image']['name'];
			
			if(isset($_FILES['new_image']['name'])){
				if($new_image != ""){
					$file_string = explode(".",$new_image);
					$ext = end($file_string);
					$new_image = "food-name-".rand(0000,9999).'.'.$ext;
					
					$source_path = $_FILES['new_image']['tmp_name'];
					$destination_path = "../images/food/".$new_image;
					// Upload image
					$upload = move_uploaded_file($source_path, $destination_path);
					if($upload ==  false){
						$_SESSION['upload'] = "<div class='error text-center'>Field to upload image.</div>";
						header('location:admin/food-update.php');
						die();
					}
					//Remove current image
					if($current_image != ""){
						$remove_path = "../images/food/".$current_image;
						$remove = unlink($remove_path);
						if($remove == false){
							$_SESSION['remove'] = "<div class='error text-center'>Field to remove current image.</div>";
							header('location:admin/food-update.php');
							die();
						}
					}
					
				}
				else{
					$new_image = $current_image;
				}
			}
			else{
				$new_image = $current_image;
			}
			
			$sql3 = "UPDATE food SET
				title = '$title',
				price = '$price',
				image = '$new_image',
				description = '$description',
				category_id = '$category',
				featured = '$featured',
				active = '$active' 
				WHERE id='$id'
			";
			$res3 = mysqli_query($conn, $sql3);
			if($res3 == true){
				$_SESSION['update'] = "<div class='success text-center'>Food updated successfully.</div>";
				?>
				<script><?php echo("href:admin/food.php';");?></script>
				<?php
				
			}
			else{
				$_SESSION['update'] = "<div class='error text-center'>Failed to updated food.</div>";
				?>
				<script><?php echo("location.href = '".SITEURL."admin/food-update.php';");?></script>
				<?php
			}

			
		}
		
	?>
  
 










