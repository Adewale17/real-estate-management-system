<?php
  require "../../config/config.php";
  require "../layout/header.php";

  if (!isset($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/admins/login-admins.php">';
}

  $properties = $conn->query("SELECT * FROM properties");
  $properties->execute();
  $allproperties = $properties->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Properties</h5>
          <a href="http://localhost/homeland/admin-panel/properties-admins/create-properties.php" class="btn btn-primary mb-4 text-center float-right">Create Properties</a>

          <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">price</th>
                <th scope="col">home type</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allproperties as $allprops): ?>
              <tr>
                <th scope="row"><?php echo $allprops->id; ?></th>
                <td><?php echo $allprops->name; ?></td>
                <td><?php echo $allprops->name; ?></td>
                <td><?php echo $allprops->home_type; ?></td>
                <td><a href="http://localhost/homeland/admin-panel/properties-admins/delete-properties.php?id=<?php echo $allprops->id; ?>"
                onclick="return confirm('Are you sure you want to delete category?')" class="btn btn-danger  text-center ">delete</a></td>
              </tr>
              <?php endforeach; ?>
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php   require "../layout/footer.php"; ?>