<?php

require "../layout/header.php";
require "../../config/config.php";

if (!isset($_SESSION['username'])) {
  echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/admins/login-admins.php">';
}

$error_message = array();
$success_message = array();


if(isset($_GET['id'])){
  $id = $_GET['id'];


  $categories = $conn->query("SELECT * FROM categories WHERE id = '$id'");
  $categories->execute();
  $category = $categories->fetch(PDO::FETCH_OBJ);


  if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
      array_push($error_message, "name column is empty");
    }else{
      $name = $_POST['name'];
      $update = $conn->query("UPDATE categories SET name = '$name' WHERE id = '$id'");
      $update->execute();
      echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/categories-admins/show-categories.php">';
    
    }
   
  }
 
}else{
  echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';


}

?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="" enctype="multipart/form-data">
          <?php require "../../includes/error.php"; ?>

            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" value="<?php echo $category->name;?>" />

            </div>


            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<?php require "../layout/footer.php"; ?>
