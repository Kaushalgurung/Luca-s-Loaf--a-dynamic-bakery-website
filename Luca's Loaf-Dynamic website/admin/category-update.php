<?php include('header.php'); ?>
   


    <!-- Categories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Update Category</h2>
			<div class="heading-border"></div>
			
            <?php 
				if(isset($_GET['id'])){
					$id = mysqli_real_escape_string($conn, $_GET['id']);
					$sql = "SELECT * FROM category WHERE id='$id'";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						if($count == 1){
							$row = mysqli_fetch_assoc($res);
							$title = $row['title'];
							$current_image = $row['image'];
							$featured = $row['featured'];
							$active = $row['active'];
						}
						else{
							header('location:'.SITEURL.'admin/category.php');
						}
					}
				}
				else{
					header('location:'.SITEURL.'admin/category.php');
				}
				
			?>
			
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-50">

                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload Image:</td>
                        <td>
							<?php 
								if($current_image != ""){
								?>
								<img src="images/category/<?php echo $current_image; ?>" alt="" width="70px" />
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
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            
			<?php
				if(isset($_REQUEST['submit'])){
					$id = $_REQUEST['id'];
					$current_image = $_REQUEST['current_image'];
					$title = $_REQUEST['title'];
					$featured = $_REQUEST['featured'];
					$active = $_REQUEST['active'];
					$new_image = $_FILES['new_image']['name'];
					
					if(isset($_FILES['new_image']['name'])){
						if($new_image != ""){
							$file_string = explode(".",$new_image);
							$ext = end($file_string);
							$new_image = "food_category_".rand(0000,9999).'.'.$ext;
							
							$source_path = $_FILES['new_image']['tmp_name'];
							$destination_path = "../images/category/".$new_image;
							// Upload image
							$upload = move_uploaded_file($source_path, $destination_path);
							if($upload ==  false){
								$_SESSION['upload'] = "<div class='error text-center'>Field to upload image.</div>";
								header('location:admin/category.php');
								die();
							}
							//Remove current image
							if($current_image != ""){
								$remove_path = "../images/category/".$current_image;
								$remove = unlink($remove_path);
								if($remove == false){
									$_SESSION['remove'] = "<div class='error text-center'>Field to remove current image.</div>";
									header('location:admin/category.php');
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
					
					$sql2 = "UPDATE category SET
						title = '$title',
						image = '$new_image',
						featured = '$featured',
						active = '$active' WHERE id='$id'
					";
					$res2 = mysqli_query($conn, $sql2);
					if($res2 == true){
						$_SESSION['update'] = "<div class='success text-center'>Category update successfully.</div>";
						?>
							<script><?php echo("href:admin/category.php");?></script>
						<?php
						
					}
					else{
						$_SESSION['update'] = "<div class='error text-center'>Failed to update category.</div>";
						?>
							<script><?php echo("location.href = '".SITEURL."admin/category.php';");?></script>
						<?php
					}

					
				}
				
			?>
			
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('footer.php'); ?>
    
   