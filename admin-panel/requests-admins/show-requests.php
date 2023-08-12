<?php
require "../../config/config.php";
require "../layout/header.php";

$requests = $conn->query("SELECT * FROM requests WHERE admin_name = '$_SESSION[username]'");
$requests->execute();
$allrequests = $requests->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Requests</h5>

          <table class="table mt-3">
            <thead>
            <?php if(count($allrequests) > 0): ?>

              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">go to this property</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($allrequests as $allrequest) :?>
              <tr>
                <th scope="row"><?php echo $allrequest->id;?></th>
                <td><?php echo $allrequest->name;?></td>
                <td><?php echo $allrequest->email;?></td>
                <td><?php echo $allrequest->phone;?></td>
                <td><a href="http://localhost/homeland/property-details.php?id=<?php echo $allrequest->property_id;?>" class="btn btn-success  text-center ">go</a></td>
              </tr>
              <?php endforeach; ?>
              <?php else: ?>
              <div class="bg-success text-white"> No One send request</div>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "../layout/footer.php"; ?>