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

    if($type == 'Employee'){

      header("Location: ../index.php");

      exit;     

    }else{



      $query = "SELECT * FROM `apply_interns` WHERE apply_by = '".mysqli_real_escape_string($link,$user['email'])."'";

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

    

    <?php

      $count = 1;

      if($data == "1"){

        echo '<table class="table table-striped">

                <thead style="color:#295EED;">

                  <tr>

                    <th scope="col">S. No.</th>

                    <th scope="col">Company Name</th>

                    <th scope="col">Position</th>

                    <th scope="col">Detail</th>

                  </tr>

                </thead>

                <tbody>';

        while($interns = mysqli_fetch_array($result)){

          $query = "SELECT * FROM `intern` WHERE id = '".mysqli_real_escape_string($link,$interns['intern_id'])."'LIMIT 1";

          $result_data = mysqli_query($link, $query);

          $intern_data = mysqli_fetch_array($result_data);

         echo'<tr>

                <th scope="row">'.$count.'</th>

                <td>'.$intern_data['company'].'</td>

                <td>'.$intern_data['title'].'</td>

                <td><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#'.$intern_data['id'].'">View</button></td>

              </tr>';

              $count++;



          echo '<div class="modal fade" id="'.$intern_data['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">

                      <div class="modal-content">

                        <div class="modal-header">

                          <h5 class="modal-title" id="exampleModalLabel" style="color:#295EED;">Submission</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                          </button>

                        </div>

                        <div class="modal-body">

                          <p><strong>QUESTION: '.$intern_data['question'].'</strong></p>

                          <p><strong>ANSWER: </strong>'.$interns['question'].'</p>

                        </div>

                      </div>

                    </div>

                  </div>';    



        }

        echo '</tbody>

          </table>';



      }else{

        echo '<div class="jumbotron jumbotron-fluid">

            <div class="container text-center">

              <h1 class="display-4">No internship applied</h1>

              <p class="lead">Apply for your 1st internships.</p>

            </div>

          </div>';

      } 



    ?>







  </div>



<?php

  include("../views/footer.html");
?>