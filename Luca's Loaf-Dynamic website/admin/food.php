<?php include('header.php'); ?>
   


    <!-- CAtegories Section Starts Here -->
    <section class="" style="padding:5% 0;">
        <div class="admin-container" >
            <h2 class="text-center">Bakery Items</h2>
			<div class="heading-border"></div>
			
			<a href="food-add.php" class="btn btn-primary admin-btn-center">Add Items</a>
            <br>
			
			<?php 
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					echo "<br>";
					unset($_SESSION['add']);
				}
				if(isset($_SESSION['remove'])){
					echo $_SESSION['remove'];
					echo "<br>";
					unset($_SESSION['remove']);
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
			?>
          
            <table class="admin-table">
               
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th colspan="2">Actions</th>
                </tr>
                
				<?php 
					$sql = "SELECT * FROM food ORDER BY id DESC";
					$res = mysqli_query($conn, $sql);
					if($res == true){
						$count = mysqli_num_rows($res);
						$sn = 1;
						if($count>0){
							while($rows = mysqli_fetch_assoc($res)){
								$id = $rows['id'];
								$title = $rows['title'];
								$price = $rows['price'];
								$image = $rows['image'];
								$description = $rows['description'];
								$category_id = $rows['category_id'];
								$featured = $rows['featured'];
								$active = $rows['active'];
								?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $price; ?></td>
									<td>
										<?php 
											if($image != ""){
											?>
											<img src="images/food/<?php $image ?>" alt="" width="50px" />
											<?php
											}
											else{
												echo "<div class='error'>Image not added.</div>";
											}
										?>
									</td>
									<td><?php echo substr($description,0,20); ?>...</td>
									<td><?php echo $category_id; ?></td>
									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td class="text-center">
										<a href="<?php ?>food-update.php?id=<?php echo $id ?>" class="btn-warning">Edit</a>
									</td>
									<td class="text-center">
										<a href="<?php ?>food-delete.php?id=<?php echo $id ?>&image=<?php echo $image ?>" class="btn-danger">Delete</a>
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