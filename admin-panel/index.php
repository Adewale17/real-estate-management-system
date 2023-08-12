<?php 

  require "layout/header.php";
  require_once "../config/config.php";
  
  $properties = $conn->query("SELECT COUNT(*) AS count_properties FROM properties");
  $properties->execute();
  $allProperties = $properties->fetch(PDO::FETCH_OBJ);
  
  
  $categories = $conn->query("SELECT COUNT(*) AS count_categories FROM categories");
  $categories->execute();
  $allCategories = $categories->fetch(PDO::FETCH_OBJ);


  $admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
  $admins->execute();
  $allAdmins= $admins->fetch(PDO::FETCH_OBJ);
  
  
  ?>


<div class="container-fluid">

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Properties</h5>
          <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
          <p class="card-text">number of properties:  <?php echo $allProperties->count_properties; ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Categories</h5>

          <p class="card-text">number of categories: <?php echo $allCategories->count_categories; ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Admins</h5>

          <p class="card-text">number of admins: <?php echo $allAdmins->count_admins; ?></p>

        </div>
      </div>
    </div>
  </div>

</div>
<?php require "layout/footer.php";?>