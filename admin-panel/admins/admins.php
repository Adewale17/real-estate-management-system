<?php

require "../layout/header.php";
require_once "../../config/config.php";

$admins = $conn->query("SELECT * FROM admins");
$admins->execute();
$alladmins = $admins->fetchAll(PDO::FETCH_OBJ);


?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Admins</h5>
        <a href="http://localhost/homeland/admin-panel/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">username</th>
              <th scope="col">email</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($alladmins as $alladmin) : ?>
              <tr>
                <th scope="row"><?php echo $alladmin->id; ?></th>
                <td><?php echo $alladmin->username; ?></td>
                <td><?php echo $alladmin->email; ?></td>

              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require "../layout/footer.php"; ?>