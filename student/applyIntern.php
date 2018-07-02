<?php



	session_start();



	$type = "";

	$error ="";

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

		if($type == 'Employee'){

			header("Location: ../index.php");

			exit;			

		}else{



			if(!isset($_GET['id'])){

				header("Location: ../index.php");

				exit;	

			}



			$query = "SELECT * FROM `apply_interns` WHERE intern_id = '".mysqli_real_escape_string($link,$_GET['id'])."' AND  apply_by = '".mysqli_real_escape_string($link,$user['email'])."' LIMIT 1";

				$result = mysqli_query($link, $query);	

				if(mysqli_num_rows($result) > 0){

					header("Location: ../index.php?apply=true");

					exit;

				}

			



			$query = "SELECT * FROM `intern` WHERE id = '".mysqli_real_escape_string($link,$_GET['id'])."' LIMIT 1";			

			if(mysqli_query($link, $query)){

				$result = mysqli_query($link, $query);	

				$intern = mysqli_fetch_array($result);

			}



			if(array_key_exists('answer', $_POST)){

				$query = "INSERT INTO `apply_interns`(`intern_id`,`post_by`, `apply_by`,`question`) VALUES ('".mysqli_escape_string($link, $intern['id'])."','".mysqli_escape_string($link, $intern['post_by'])."','".mysqli_escape_string($link, $user['email'])."','".mysqli_escape_string($link, $_POST['answer'])."')";



				if(mysqli_query($link, $query)){

					header("Location: ../index.php?apply=1");	

					exit;

				}else{

					$error = "There is some problem! please try again";

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

			<div class="container">

				<h2 class="text-center">Internship at <?php echo $intern['company']?></h2>

				<hr>

				<form method="post">

				  <div class="form-group">

				    <label for="about"><strong>Question: <?php echo $intern['question']?> </strong></label>

				    <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>

				  </div>

				  <button type="submit" class="btn btn-primary">Post</button>

				</form>

			</div>	

		</div>

	</div>




<?php

	include("../views/footer.html");
?>