<?php

	session_start();

	$error = "";
	$success = "";
	$type = "";
	
	if(array_key_exists("logout", $_GET)){

		unset($_SESSION);
		session_destroy();
		setcookie("id", "", time() - 60*60*24*356 );
		setcookie("id", "", time() - 60*60*24*356 );
		$_COOKIE["id"] = "";

		header("Location: index.php");
	}else if((array_key_exists("id", $_SESSION)  AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'] )){
		
		
	
	}


	if(array_key_exists("id", $_COOKIE) AND $_COOKIE['id']){

		$_SESSION['id'] = $_COOKIE['id'];
	}	

	include("connection.php");

	if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){

		if($_POST['email'] == ''){

			$error = "Enter Your Email";

		}else if($_POST['password'] == ''){

			$error = "Enter Your Password";

		}else{

			if($_POST['sign'] == '1'){

				//######## php code for For sign up part  ###############

				if($_POST['password'] != $_POST['ConfirmPassword']){

					$error = "Password does't match";
				}else{

					$query = "SELECT `id` FROM `user_detail` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'LIMIT 1";

					$result = mysqli_query($link, $query);


					if(mysqli_num_rows($result) > 0){
				
						$error = "Email already registered.";

					}else{

						$query = "SELECT `id` FROM `unverified_user` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'LIMIT 1";

						$result = mysqli_query($link, $query);
						if(mysqli_num_rows($result) > 0){
				
							$error = "Email already registered, Please verify your account";

						}else{

							$email = $_POST['email'];
							$hash  = md5(md5( rand(0,1000)));
							$query = "INSERT INTO `unverified_user`(`f_name`,`l_name`,`email`, `password`,`type`,`hash`) VALUES ('".mysqli_escape_string($link, $_POST['fname'])."','".mysqli_escape_string($link, $_POST['lname'])."','".mysqli_escape_string($link, $_POST['email'])."','".mysqli_escape_string($link, md5($_POST['password']))."','".mysqli_escape_string($link, $_POST['type'])."','".mysqli_escape_string($link, $hash)."')";

							if(mysqli_query($link, $query)){
						
								// $query = "UPDATE `user_detail` SET password = '". md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = '".mysqli_insert_id($link)."'LIMIT 1";

								// if(mysqli_query($link, $query)){

									$recipient = $email;
							        $subject = "Active your account";
							        $email_content = 'Please Click On This link http://rsinghal26.gq/intern/login/verify.php?email='.$email.'&hash='.$hash.' to activate  your account.';
							        $email_headers = "From: project@mysite.com";

							        if (mail($recipient, $subject, $email_content, $email_headers)) {

							            http_response_code(200);
							            header("Location: index.php?m=1");
							           
							        } else {
							            http_response_code(500);
							            $error = "Oops! Something went wrong and we couldn't send your message.";
							        }
									
								// }

							}else{

								 $error = "Could not sign you up- Please try again ";
								 header("Location: index.php");
								 exit;

							}

						}

					}
				}		

			}else if($_POST['sign'] == '0'){

					//######## php code for For login part  ###############

				$query = "SELECT * FROM `user_detail` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'LIMIT 1";

				$result = mysqli_query($link, $query); 
				$row = mysqli_fetch_array($result);

				if(isset($row)){

					$codedPassword = md5(md5($row['id']).md5($_POST['password']));

					if($codedPassword == $row['password']){

						$_SESSION['id'] = $row['id'];

							if(isset($_POST['stayloggedin']) AND $_POST['stayloggedin'] == '1'){

								setcookie('id', mysqli_insert_id($link), time() + 60*60*24*365 );

							}

							 header("Location: index.php");
							 exit;
					}else{

						 $error = "Invalid Password or Email id.";
					}
				}else{

						 $error = "Invalid Password or Email id. ";
				}
			}
		}		
	}


	if(isset($_GET['apply']) AND $_GET['apply'] == 'true'){
		$error = "You have already applied for this intern";
	}else if(isset($_GET['post']) AND $_GET['post'] == 'true'){
		$success = "Internship successfully posted.";
	}else if(isset($_GET['apply']) AND $_GET['apply'] == 1){
		$success = "You have successfully applied";
	}else if(isset($_GET['m']) AND $_GET['m'] == 1){
		$success = "An verification link have sent to your registered email id";
	}else if(isset($_GET['m']) AND $_GET['m'] == 2){
		$success = "An conformation link have been sent to your registered email id";
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.php">INTERN</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav ml-auto">
	    <?php 
	    	if(isset($_SESSION) AND array_key_exists('id', $_SESSION) AND $_SESSION['id']){

	    		$query = "SELECT * FROM `user_detail` WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
				if(mysqli_query($link, $query)){
					$result = mysqli_query($link, $query);	
					$user = mysqli_fetch_array($result);
					$type = $user['type'];
				}
	    		echo '<li class="nav-item">
		        			<strong class="nav-link">Welcome '.ucfirst($user['f_name']).'</strong>
		      			</li>';
		        echo "<form class='form-inline my-2 my-lg-0'>
		      			<button class='btn btn-outline-success my-2 my-sm-0' type='submit'><a href='index.php?logout=1'>Log out</a></button>
		    		</form>";

		    	if($type == 'Employee'){
		    		echo '<li class="nav-item">
		        			<button class="btn btn-outline-success btn-sm nav-link" type="button" style="margin-left:10px;"><a href="employee/postIntern.php">Post internships</a></button>
		      			</li>
		      			<li class="nav-item">
		        			<button class="btn btn-outline-success btn-sm nav-link" type="button" style="margin-left:10px;"><a href="employee/response.php">View response</a></button>
		      			</li>';
		    	}else{
		    		echo '<li class="nav-item">
		        			<button class="btn btn-outline-success btn-sm nav-link" type="button" style="margin-left:10px;"><a href="student/appliedIntern.php">Your applications</a></button>
		      			</li>';
		    	}	

		    	

		    }else{
		    	echo '<li class="nav-item">
		        		<button class="btn btn-outline-primary btn-sm nav-link" type="button" style="margin-left:10px;"  data-toggle="modal" data-target="#login" >Log in</button>
		      		</li>
		      		<li class="nav-item">
		      			<button class="btn btn-outline-primary btn-sm nav-link" type="button" style="margin-left:10px;" data-toggle="modal" data-target="#signUp">Sign Up</button>
		      		</li>';	
		    }  
		 ?>     
	    </ul>
	  </div>
	</nav>

	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel" style="color:#295EED;">Log In</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form method="post">
	        	<div class="form-group">
				    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
		    	</div>
				<div class="form-group">
				    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
				</div>
				<div class="form-check">
					<label class="form-check-label">
					    <input type="checkbox" name="stayloggedin" value="1" class="form-check-input">
					      Remember me
					     
					</label>
			    </div>
			    <a class="nav-link" href="login/forgetPass.php" style="margin-left: -13px;">Forget password</a> 
				<input type="hidden" name="sign" value="0" >
				<button type="submit" class="btn btn-primary" style="padding :5px 40px;">Log In</button>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel" style="color:#295EED;">Sign Up</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form method="post">
	        	<div class="form-group">
				    <input type="text" name="fname" class="form-control" id="fname" placeholder="First name" required>
				</div>
	        	<div class="form-group">
				    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last name" required>
				</div>
			    <div class="form-group">
				    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
		    	</div>
				<div class="form-group">
				    <input type="password" name="password" pattern=".{6,}" title="6 characters minimum" class="form-control" id="password" placeholder="Password" required>
				</div>
				<div class="form-group">
				    <input type="password" name="ConfirmPassword" class="form-control" id="password" placeholder="Confirm Password" required>
				</div>
				 <div class="form-group">
				    <label for="exampleFormControlSelect1">Type</label>
				    <select class="form-control" name="type" id="exampleFormControlSelect1" required>
				      <option>Student</option>
				      <option>Employee</option>
				    </select>
				 </div>
				 <input type="hidden" name="sign" value="1" >
				<button type="submit" class="btn btn-primary"  style="padding :5px 40px;">Sign Up</button>
			</form>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- body -->

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


		<div class="justify-content-center">
			<?php 
				$query = "SELECT * FROM `intern`";
				if(mysqli_query($link, $query)){
					$result = mysqli_query($link, $query);	
				
					while($row = mysqli_fetch_assoc($result)) {
					    echo '<div class="card col-md-8">
								<div class="card-header" style="color:#295EED;"><strong>'
								 	.strtoupper($row['company']).
								'</strong></div>
								<div class="card-body">
								    <h5 class="card-title">'.ucfirst($row['title']).'</h5><hr>
								    <p class="card-text">'.$row['about'].'</p>';
								    if($type == "Student"){
								    	echo '<a href="student/applyIntern.php?id='.$row['id'].'" class="btn btn-outline-primary">Apply now</a>';
								    }else if($type == "Employee"){
								    	
								    }else{
								    	echo '<a data-toggle="modal" data-target="#login" class="btn btn-outline-primary">Apply now</a>';
								    }
								    
							echo'</div>
							  </div>';
			
					}
					
				}


			?>
		</div>
	</div>

<?php

	include("views/footer.html");
?>