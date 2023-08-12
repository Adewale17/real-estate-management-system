<?php
if (isset($_SESSION['username'])) {
    echo "<script>windows.location.href='http://localhost/homeland'</script>";

  }
    require_once "../config/config.php";
    //session validation for register page 

    $error_message = array();
    $success_message = array();
    //register session
    if (isset($_POST['register'])) {
  
        if (empty($_POST["username"]) or empty($_POST["email"]) or empty($_POST["password"])) {
            array_push($error_message, "one or more column is empty");
        } else {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST['password'];
  
            //check email availability
  
            $email_check = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $email_check->execute();
            $email_count = $email_check->rowCount();
            if ($email_count > 0) {
                array_push($error_message, "$email already exist");
            }
  
            //check username availability
            $usernameCheck = $conn->query("SELECT * FROM users WHERE username = '$username'");
            $usernameCheck->execute();
            $username_count = $usernameCheck->rowCount();
            if ($username_count > 0) {
                array_push($error_message, "$username already exist");
            }
  
            //insert query
            if (count($error_message) < 1) {
                $register = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
               
                    $register->execute([
                        ":username" => $username,
                        ":email" => $email,
                        ":password" => password_hash($password,PASSWORD_DEFAULT)
                    ]);
               
                echo '<meta http-equiv="refresh" content="0;url=login.php">';
            }
  
            
        }
  }
  

//Login Session
 
if(isset($_POST['login'])){
    if(empty($_POST['email']) OR empty($_POST['password'])){
        array_push($error_message, "One or more column is empty");
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
  
        $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
        $login->execute();
  
        $fetch = $login->fetch(PDO::FETCH_ASSOC);
        if($login->rowCount() > 0 ){
            if(password_verify($password, $fetch['password'])){
              
                // header("location:http://localhost/homeland");
                //session validation
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['email'] = $fetch['email'];
                $_SESSION['user_id'] = $fetch['id'];

                echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland">';
            


            }else{
                array_push($error_message, "Incorrect Email or Password");
            }
            
        }else{
          array_push($error_message, "Incorrect Email or Password");
        }
    }
  }

//index session

  