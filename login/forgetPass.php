<?php

$error = "";
$flag = 0;

if(isset($_POST['email']) && !empty($_POST['email'])){

	include("../connection.php");

	$query = "SELECT * FROM `user_detail` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'LIMIT 1";
	$result = mysqli_query($link, $query); 
	$row = mysqli_fetch_array($result);

	if(isset($row)){

		$email = $row['email'];
		$hash  = md5(md5( rand(0,1000)));

		$query = "SELECT * FROM `forget_pass` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'LIMIT 1";
		$result = mysqli_query($link, $query); 
		if(mysqli_num_rows($result) > 0){
			
			$data = mysqli_fetch_array($result);
			$hash = $data['hash'];
			$flag = 1;
		}else{
			$query = "INSERT INTO `forget_pass`(`email`,`hash`) VALUES ('".mysqli_escape_string($link,$email)."','".mysqli_escape_string($link, $hash)."')";
			if(mysqli_query($link, $query)){
				$flag = 1;
			}

		}		
		
		if($flag == 1){
						
			$recipient = $email;
			$subject = "Forget password request";
			$email_content = 'Please Click On This link http://rsinghal26.gq/intern/login/restPass.php?email='.$email.'&hash='.$hash.' to change your password.';
			$email_headers = "From: project@mysite.com";
			if (mail($recipient, $subject, $email_content, $email_headers)) {
				http_response_code(200);
				header("Location: ../index.php?m=2");
							           
			} else {
				http_response_code(500);
		        $error = "Oops! Something went wrong and we couldn't send your message.";
			}

		}

	}else{
		$error = "Email does not registered";
	}


}

?>
<?php

	include("../views/header.html");
?>

	<div id="message" >
			<?php 
				if($error != ""){
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>'.$error.'</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						</div>' ;

				}
			?>		
	</div>




	<div class="container justify-content-center">
		<div class="card col-md-6">
			<div class="container text-center" style="padding: 20px; color: #295EED">
				<h3>Forget password</h3>
				<hr>
				<form method="post">
			        <div class="form-group">
					    <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email" required>
					</div>
					<button type="submit" class="btn btn-primary"  style="padding :5px 40px;">Submit</button>
				</form>
			</div>
		</div>
	</div>


<?php

	include("../views/footer.html");
?>