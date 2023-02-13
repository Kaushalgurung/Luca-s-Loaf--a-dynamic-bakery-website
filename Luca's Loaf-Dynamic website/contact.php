<?php
	ob_start();
	include('header.php'); 
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="contact">
        <div class="container">
            
            <h2 class="text-center">Get in touch.</h2>
			<div class="heading-border"></div>
			
			<?php
				if(isset($_SESSION['contact'])){
					echo $_SESSION['contact'];
					unset($_SESSION['contact']);
				}
			?>

            <form action="" method="POST" class="contact-form">
               
                <fieldset>
                    <h2>Contact Us</h2>
                    <div class="contact-label">Full Name</div>
                    <input type="text" name="name" placeholder="Enter your name..." class="input-responsive" required>
					
                    <div class="contact-label">Email</div>
                    <input type="email" name="email" placeholder="Enter your email..." class="input-responsive" required>

                    <div class="contact-label">Phone Number</div>
                    <input type="tel" name="phone" placeholder="Enter your phone..." class="input-responsive" required>

                    <div class="contact-label">Subject</div>
                    <input type="text" name="subject" placeholder="Enter your subject..." class="input-responsive" required>

                    <div class="contact-label">Message</div>
                    <textarea name="message" rows="5" placeholder="Enter your message..." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </fieldset>

            </form>
			
			<?php
				if(isset($_REQUEST['submit'])){
					$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
					$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
					$phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);
					$subject = mysqli_real_escape_string($conn, $_REQUEST['subject']);
					$message = mysqli_real_escape_string($conn, $_REQUEST['message']);
					$sql = "INSERT INTO contact SET
						name = '$name',
						email = '$email',
						phone = '$phone',
						subject = '$subject',
						message = '$message',
						status = 'Unread'
					";
					$res = mysqli_query($conn, $sql);
					if($res ==  true){
						$_SESSION['contact'] = "<div class='success text-center'>Message sent successfully.</div>";
						header('location:contact.php');
					}
					else{
						$_SESSION['contact'] = "<div class='error text-center'>Faild to message.</div>";
						header('location:contact.php');
					}
					
					
				}
			?>
			
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
	
	<!-- Map Start Here -->
	<section class="Map">
		<h2 class="text-center">Find us</h2>
		<div class="heading-border"></div>
		<div class="mapouter">
			<div class="gmap_canvas">
				<iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Chittagogn,%20Bangladesh&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" marginheight="0" marginwidth="0"></iframe>
			</div>
		</div>
	</section>
	<!-- Map End Here-->	

<?php 
	include('footer.php'); 
	ob_flush();
?>