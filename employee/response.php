<?php 



	session_start();



	$type = "";

	$data = "0";



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



			$query = "SELECT * FROM `intern` WHERE post_by = '".mysqli_real_escape_string($link,$user['email'])."'";

			$result = mysqli_query($link, $query);	

			if(mysqli_num_rows($result) > 0){

				$data = "1";

				$result = mysqli_query($link, $query);	

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

		<div id="accordion">

		<?php



			if($data == "1"){	 

				while($interns = mysqli_fetch_array($result)) {



					$query = "SELECT * FROM `apply_interns` WHERE intern_id = '".mysqli_real_escape_string($link,$interns['id'])."'";

					$result_data = mysqli_query($link, $query);

	

				echo '<div class="card">

					    <div class="card-header" id="headingOne">

					      <h5 class="mb-0" style="color:#295EED;">

					          Intern at ' .$interns['company']. ' for '.$interns['title'].

					      '</h5>

					    </div>



					    <div data-parent="#accordion">

					      <div class="card-body">';

						while($applyData = mysqli_fetch_array($result_data)) {

							

							$query = "SELECT * FROM `user_detail` WHERE email = '".mysqli_real_escape_string($link,$applyData['apply_by'])."'";

							$result_user = mysqli_query($link, $query);	

							$applyUser = mysqli_fetch_array($result_user);



					    	echo '<div class="list-group" id="list-tab" role="tablist" >

							      <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="modal" data-target="#'.$applyData['apply_id'].'" role="tab"><b>Apply by student:</b> '.$applyUser['f_name'].' '.$applyUser['l_name'].' <b>Email ID</b>: '.$applyUser['email'].'</a>

							    </div>';



							 echo '<div class="modal fade" id="'.$applyData['apply_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

									  <div class="modal-dialog" role="document">

									    <div class="modal-content">

									      <div class="modal-header">

									        <h5 class="modal-title" id="exampleModalLabel" style="color:#295EED;">Submission</h5>

									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

									          <span aria-hidden="true">&times;</span>

									        </button>

									      </div>

									      <div class="modal-body">

									      	<p><strong>QUESTION: '.$interns['question'].'</strong></p>

									        <p><strong>ANSWER: </strong>'.$applyData['question'].'</p>

									      </div>

									    </div>

									  </div>

									</div>';

						}    

					    echo '</div>

					    </div>

				  </div>';

				  

				}

			}else{

				echo '<div class="jumbotron jumbotron-fluid">

					  <div class="container text-center">

					    <h1 class="display-4">No internship posted</h1>

					    <p class="lead">Post your internships.</p>

					  </div>

					</div>';

			}	



		?>



		</div>

	</div>


<?php

	include("../views/footer.html");
?>