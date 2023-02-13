<?php 
	include('header.php'); 
?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Catagories</h2>
			<div class="heading-border"></div>

            <?php 
				$sql = "SELECT * FROM category WHERE active='Yes' ORDER BY id DESC";
				$res = mysqli_query($conn, $sql);
				if($res == true){
					$count = mysqli_num_rows($res);
					if($count>0){
						while($rows = mysqli_fetch_assoc($res)){
							$id = $rows['id'];
							$title = $rows['title'];
							$image = $rows['image'];
							?>
							<a href="category-foods.php?category_id=<?php echo $id ?>">
								<div class="box-3 float-container">
									<?php 
										if($image != ""){
										?>
										<img src="images/category/<?php echo $image; ?>" alt=""  class="img-responsive img-curve" />
										<?php
										}
										else{
											echo "<div class='error'>Image not avilable.</div>";
										}
									?>
									

									<h3 class="float-text text-white"><?php echo $title ?></h3>
								</div>
							</a>
							<?php
						}
					}
					else{
						echo "<div class='error'>Categories not avilable.</div>";
					}
				}
			?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php 
	include('footer.php'); 
?>