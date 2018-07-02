<?php

$error = "";

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

	include("../connection.php");
	$email = mysqli_real_escape_string($link,$_GET['email']); 
    $hash = mysqli_real_escape_string($link,$_GET['hash']); 

    $query = "SELECT * FROM `forget_pass` WHERE email = '".$email."' AND hash = '".$hash."' LIMIT 1";

    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_array($result);
   
	if(mysqli_num_rows($result) > 0){
		
		if(isset($_POST['password']) && !empty($_POST['ConfirmPassword'])){

			if($_POST['password'] != $_POST['ConfirmPassword']){

				$error = "Password does't match";
			}else{

				$query = "SELECT `id` FROM `user_detail` WHERE email = '".mysqli_real_escape_string($link, $email)."'LIMIT 1";

				$result = mysqli_query($link, $query);
				if(mysqli_num_rows($result) > 0){

					$row = mysqli_fetch_array($result);
					$id = $row['id'];
								
					$query = "UPDATE `user_detail` SET password = '". md5(md5($id).md5($_POST['password']))."' WHERE id = '".$id."' LIMIT 1";
					if(mysqli_query($link, $query)){

						$query = "DELETE FROM `forget_pass` WHERE email = '".mysqli_real_escape_string($link, $email)."'LIMIT 1";
						if(mysqli_query($link, $query)){

							$success = "Password has been changed please <a href='../index.php'> log in </a> your account.";

						}

					}

				}else{

					$error = "Email does't exist..please sign up";
				}
			}

		}



	}else{

		$error = "User does not exist";
	}


}else{

    $error = "Invalid entry please go to the home page";

}

?>

<?php

	include("../views/header.html");
?>



	<div class="container justify-content-center">
		<div id="message" >
			<?php 
				if($error != ""){
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>'.$error.'</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						</div>' ;

				}else if($success !=""){
					echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>'.$success.'</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						</div>';
				}
			?>		
	</div>

		<div class="card col-md-6">
			<div class="container text-center" style="padding: 20px; color: #295EED">
				<h3>Reset password</h3>
				<hr>
				<form method="post">
			        <div class="form-group">
					    <input type="password" name="password" pattern=".{6,}" title="6 characters minimum" class="form-control" id="password" placeholder="New Password" required>
					</div>
					<div class="form-group">
					    <input type="password" name="ConfirmPassword" class="form-control" id="password" placeholder="Confirm Password" required>
					</div>
					<button type="submit" class="btn btn-primary"  style="padding :5px 40px;">Submit</button>
				</form>
			</div>
		</div>
	</div>


<?php

	include("../views/footer.html");
?>