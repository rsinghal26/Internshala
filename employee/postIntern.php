<?php

	session_start();

	$type = "";
	$error = "";

	if(array_key_exists("id", $_COOKIE) AND $_COOKIE['id']){

		$_SESSION['id'] = $_COOKIE['id'];
	}

	if(array_key_exists('id', $_SESSION) AND $_SESSION['id']){

		include("../connection.php");

		$query = "SELECT * FROM `user_detail` WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		if(mysqli_query($link, $query)){
			$result = mysqli_query($link, $query);	
			$user = mysqli_fetch_array($result);
			$type = $user['type'];
		}	
		if($type == 'Student'){
			header("Location: ../index.php");
			exit;			
		}else{

			if(array_key_exists('company', $_POST) OR array_key_exists('title', $_POST)){

				$query = "SELECT * FROM `intern` WHERE company = '".mysqli_real_escape_string($link,$_POST['company'])."' AND title = '".mysqli_real_escape_string($link,$_POST['title'])."' LIMIT 1";
				$result = mysqli_query($link, $query);
				if(mysqli_num_rows($result) > 0){
				
					$error = "This intern has already registered";

				}else{

					$query = "INSERT INTO `intern`(`company`,`title`,`about`, `post_by`,`question`) VALUES ('".mysqli_escape_string($link, $_POST['company'])."','".mysqli_escape_string($link, $_POST['title'])."','".mysqli_escape_string($link, $_POST['about'])."','".mysqli_escape_string($link, $user['email'])."','".mysqli_escape_string($link, $_POST['question'])."')";

					if(mysqli_query($link, $query)){
						header("Location: ../index.php?post=true");	
						exit;
					}else{
						$error = "There is some problem! please try again";
					}

				}
	
			}
		}	

	}else{

		header("Location: ../index.php");
		exit;
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
				}
			?>		
		</div>


		<div class="card internPost">
			<form method="post">
			  <div class="form-group">
			    <label for="company">Company Name</label>
			    <input type="text" class="form-control" id="company" name="company" placeholder="Enter" required>
			  </div>
			  <div class="form-group">
			    <label for="title">Intern Title</label>
			    <input type="text" class="form-control" id="title" name="title" placeholder="title" required>
			  </div>
			  <div class="form-group">
			    <label for="about">About the intern</label>
			    <textarea class="form-control" id="about" name="about" rows="3"></textarea>
			  </div>
			  <div class="form-group">
			    <label for="about">Question for student</label>
			    <input type="text" class="form-control" id="question" name="question" required>
			  </div>
			  <button type="submit" class="btn btn-primary">Post</button>
			</form>
		</div>
	</div>

<?php

	include("../views/footer.html");
?>