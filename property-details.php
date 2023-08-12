<?php

require "includes/header.php";
require "config/config.php";
// if(!isset($_SESSION['username'])){
//   echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland">';
// }

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $details = $conn->query("SELECT * FROM properties WHERE id = '$id'");
  $details->execute();
  $alldetails = $details->fetch(PDO::FETCH_OBJ);


  $images = $conn->query("SELECT * FROM relatedimages WHERE property_id = '$id'");
  $images->execute();
  $allImages = $images->fetchAll(PDO::FETCH_OBJ);
  // var_dump($allImages);

  $relatedProperties = $conn->query("SELECT * FROM properties WHERE home_type = '$alldetails->home_type' AND id != '$id'");
  $relatedProperties->execute();
  $allRelatedProps = $relatedProperties->fetchAll(PDO::FETCH_OBJ);

  //check the session the check if user add property to favourite
  if (isset($_SESSION['user_id'])) {
    $check = $conn->query("SELECT * FROM favs WHERE property_id ='$id' AND user_id ='$_SESSION[user_id]'");
    $check->execute();
    $fetch_check = $check->fetch(PDO::FETCH_OBJ);
  }

  //Checking for property request
  if (isset($_SESSION['user_id'])) {
    $requestCheck = $conn->query("SELECT * FROM requests WHERE property_id ='$id' AND user_id ='$_SESSION[user_id]'");
    $requestCheck->execute();
  }
} else {
  echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';
}



?>
</div>

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(http://localhost/homeland/images/<?php echo $alldetails->image; ?>">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
        <h1 class="mb-2"><?php echo $alldetails->name; ?></h1>
        <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo $alldetails->price; ?></strong></p>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div>

          <div class="slide-one-item home-slider owl-carousel">
            <?php foreach ($allImages as $image) : ?>
              <div><img src="images/<?php print $image->image; ?>" alt="Image" class="img-fluid"></div>
            <?php endforeach; ?>
          </div>

        </div>
        <div class="bg-white property-body border-bottom border-left border-right">
          <div class="row mb-5">
            <div class="col-md-6">
              <strong class="text-success h1 mb-3">$<?php echo $alldetails->price; ?></strong>
            </div>
            <div class="col-md-6">
              <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number"><?php echo $alldetails->beds; ?><sup></sup></span>

                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number"><?php echo $alldetails->baths; ?></span>

                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number"><?php echo $alldetails->sq_ft; ?></span>

                </li>
              </ul>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
              <strong class="d-block"><?php echo str_replace('-', ' ', $alldetails->home_type); ?></strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
              <strong class="d-block"><?php echo $alldetails->year_built; ?></strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
              <strong class="d-block">$<?php echo $alldetails->price_sqft; ?></strong>
            </div>
          </div>
          <h2 class="h4 text-black">More Info</h2>
          <p><?php echo $alldetails->description; ?></p>

          <div class="row no-gutters mt-5">
            <div class="col-12">
              <h2 class="h4 text-black mb-3">Gallery</h2>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <?php foreach ($allImages as $image) : ?>
                <a href="images/<?php echo $image->image; ?>" class="image-popup gal-item"><img src="images/<?php echo $image->image; ?>" alt="Image" class="img-fluid"></a>
              <?php endforeach; ?>
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-4">

        <div class="bg-white widget border rounded">

          <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
          <?php if (isset($_SESSION['user_id'])) : ?>
            <?php if ($requestCheck->rowCount() > 0) : ?>
              <p class="bg-primary text-white ">You have already sent a request to this property, you cannot send another one </p>
            <?php else : ?>
              <form action="request/contact-agent.php" class="form-contact-agent" method="post">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" name="phone" class="form-control">
                </div>
                <div class="form-group">
                  <input type="hidden" id="propert_id" name="property_id" value="<?php echo $id; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <input type="hidden" id="phone" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <input type="hidden" id="admin_name" name="admin_name" value="<?php echo $alldetails->admin_name; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" value="Send Message">
                </div>
              </form>
            <?php endif; ?>
          <?php else : ?>
            <p>login to send messsage to the agent</p>
          <?php endif; ?>
        </div>

        <div class="bg-white widget border rounded">
          <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
          <div class="px-3" style="margin-left: -15px;">
            <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/homeland/property-details.php?id=<?php echo $alldetails->id; ?>&quote=<?php echo $alldetails->name; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?text==<?php echo $alldetails->name; ?>&url=http://localhost/homeland/property-details.php" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://localhost/homeland/property-details.php" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
          </div>
        </div>

        <div class="bg-white widget border rounded">
          <h3 class="h4 text-black widget-title mb-3 ml-0">Add this to Fav</h3>
          <div class="px-3" style="margin-left: -15px;">
            <?php if (isset($_SESSION['user_id'])) : ?>
              <form action="favs/add-fav.php" class="form-contact-agent" method="POST">
                <div class="form-group">
                  <input type="hidden" id="Property_id" name="property_id" value="<?php echo $id; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control">
                </div>
                <?php if ($check->rowCount() > 0) : ?>
                  <div class="form-group">
                    <a href="favs/delete-fav.php?property_id=<?php echo $id; ?>&user_id=<?php echo $_SESSION["user_id"]; ?>" class="btn btn-primary text-white" value="" disabled> Remove From Fav</a>
                  </div>
                <?php else : ?>
                  <div class="form-group">
                    <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Add to Fav">
                  </div>
                <?php endif; ?>
              </form>
            <?php else : ?>
              <p>login to to add property to favorite</p>
            <?php endif; ?>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<div class="site-section site-section-sm bg-light">
  <div class="container">

    <div class="row">
      <div class="col-12">
        <div class="site-section-title mb-5">
          <h2>Related Properties</h2>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <?php foreach ($allRelatedProps as $relatedProps) : ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="property-entry h-100">
            <a href="property-details.php?id=<?php echo $relatedProps->id; ?>" class="property-thumbnail">
              <div class="offer-type-wrap">
                <span class="offer-type bg-<?php if ($relatedProps->type == "rent") {
                                              echo "success";
                                            } else {
                                              echo "danger";
                                            } ?>"><?php echo $relatedProps->type; ?></span>
              </div>
              <img src="images/<?php echo $relatedProps->image; ?>" alt="Image" class="img-fluid">
            </a>
            <div class="p-4 property-body">
              <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
              <h2 class="property-title"><a href="property-details.php?id=<?php echo $relatedProps->id; ?>"><?php echo $relatedProps->name; ?></a></h2>
              <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $relatedProps->location; ?></span>
              <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $relatedProps->price; ?></strong>
              <ul class="property-specs-wrap mb-3 mb-lg-0">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number"><?php echo $relatedProps->beds; ?> <sup>+</sup></span>

                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number"><?php echo $relatedProps->baths; ?></span>

                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number"><?php echo $relatedProps->sq_ft; ?></span>

                </li>
              </ul>

            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>



  <?php require "includes/footer.php"; ?>