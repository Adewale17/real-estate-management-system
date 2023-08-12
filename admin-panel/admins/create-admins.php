

<?php 


  require "../../config/config.php"; 
  require "../layout/header.php";

  if(!isset($_SESSION['username'])){
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/admins/login-admins.php">';
  }

  $error_message = array();
    $success_message = array();
    //register session
    if (isset($_POST['submit'])) {
  
        if (empty($_POST["username"]) or empty($_POST["email"]) or empty($_POST["password"])) {
            array_push($error_message, "one or more column is empty");
        } else {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST['password'];
  
            //check email availability
  
            $email_check = $conn->query("SELECT * FROM admins WHERE email = '$email'");
            $email_check->execute();
            $email_count = $email_check->rowCount();
            if ($email_count > 0) {
                array_push($error_message, "$email already exist");
            }
  
            //check username availability
            $usernameCheck = $conn->query("SELECT * FROM admins WHERE username = '$username'");
            $usernameCheck->execute();
            $username_count = $usernameCheck->rowCount();
            if ($username_count > 0) {
                array_push($error_message, "$username already exist");
            }
  
            //insert query
            if (count($error_message) < 1) {
                $register = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
               
                    $register->execute([
                        ":username" => $username,
                        ":email" => $email,
                        ":password" => password_hash($password,PASSWORD_DEFAULT)
                    ]);
               
                echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/admins/admins.php">';
            }
  
            
        }
  }



?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
          <?php require "../../includes/error.php"; ?>

              <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
              </div>
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
<script type="text/javascript">

</script>
</body>
</html>