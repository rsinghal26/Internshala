<?php

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

	include("../connection.php");
	$email = mysqli_real_escape_string($link,$_GET['email']); 
    $hash = mysqli_real_escape_string($link,$_GET['hash']); 

    $query = "SELECT * FROM `unverified_user` WHERE email = '".$email."' AND hash = '".$hash."' LIMIT 1";

    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_array($result);
   
	if(mysqli_num_rows($result) > 0){
		
		$query = "INSERT INTO `user_detail`(`f_name`,`l_name`,`email`, `password`,`type`) VALUES ('".mysqli_escape_string($link, $data['f_name'])."','".mysqli_escape_string($link, $data['l_name'])."','".mysqli_escape_string($link, $data['email'])."','".mysqli_escape_string($link, $data['password'])."','".mysqli_escape_string($link, $data['type'])."')";

		if(mysqli_query($link, $query)){

			$query = "UPDATE `user_detail` SET password = '". md5(md5(mysqli_insert_id($link)).$data['password'])."' WHERE id = '".mysqli_insert_id($link)."'LIMIT 1";
			if(mysqli_query($link, $query)){

				$query = "DELETE FROM `unverified_user` WHERE email = '".mysqli_real_escape_string($link, $email)."'LIMIT 1";
				if(mysqli_query($link, $query)){

					$success = "You are successfully verified please go to log in page";

				}else{

					$error = "Something gose wrong in deletion";	

				}
			}	

		}else{

			$error = "Something gose wrong";	
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

	<div class="container">

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

		<a class="btn btn-primary" href="../index.php" role="button">Go back to home</a>

	</div>	


<?php

	include("../views/footer.html");
?>