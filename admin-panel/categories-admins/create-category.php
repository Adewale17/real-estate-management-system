<?php


require "../../config/config.php";
require "../layout/header.php";

if (!isset($_SESSION['username'])) {
  echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/admins/login-admins.php">';
}
$success_message = array();
$error_message = array();
if(isset($_POST['submit'])){
  

  if(empty($_POST['name'])){
    array_push($error_message, "Column is empty");
  }else{
    $name = $_POST['name'];

    $nameCheck = $conn->query("SELECT * FROM categories WHERE name = '$name'");
    $nameCheck->execute();
    $name_count = $nameCheck->rowCount();
    if ($name_count > 0) {
        array_push($error_message, "$name already exist");
    }
    if( count($error_message) < 1){
      $insert = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");
      $insert->execute([":name"=>$name]);


      echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/categories-admins/show-categories.php">';

    }
  }
}

?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

            </div>


            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<?php  require "../layout/footer.php"; ?>