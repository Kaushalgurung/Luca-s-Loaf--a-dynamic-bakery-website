<?php include('header.php'); ?>
   


    <!-- Categories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="container" >
            <h2 class="text-center">Add Category</h2>
			<div class="heading-border"></div>

			<?php 
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
				if(isset($_SESSION['upload'])){
					echo $_SESSION['upload'];
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
                        <td>Upload Image:</td>
                        <td>
                            <input type="file" name="image">
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
                            <input type="submit" name="submit" value="Add Category" class="btn btn-secondary">
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
					$image = "food_category_".rand(0000,9999).'.'.$ext;
					
					$source_path = $_FILES['image']['tmp_name'];
					$destination_path = "../images/category/".$image;
					// Upload image
					$upload = move_uploaded_file($source_path, $destination_path);
					if($upload ==  false){
						$_SESSION['upload'] = "<div class='error text-center'>Field to upload image.</div>";
						header('location:admin/category-add.php');
						die();
					}
				}
				
			}
			else{
				$image="";
			}
			
			$sql = "INSERT INTO category SET
				title = '$title',
				image = '$image',
				featured = '$featured',
				active = '$active'
			";
			$res = mysqli_query($conn, $sql);
			if($res == true){
				$_SESSION['add'] = "<div class='success text-center'>Category added successfully.</div>";
				?>
					<script><?php echo('location:admin/category.php');?></script>
				<?php
				
			}
			else{
				$_SESSION['add'] = "<div class='error text-center'>Failed to add category.</div>";
				header('location:admin/category-add.php');
			}

			
        }
        
    ?>
   
  
 










