<?php

require "includes/header.php";
require "config/config.php";

$select = $conn->query("SELECT * FROM properties");
$select->execute();
$properties = $select->fetchAll(PDO::FETCH_OBJ);

if(isset($_GET['type'])){
    $type = $_GET['type'];

    $sale = $conn->query("SELECT * FROM properties WHERE type = '$type'");
    $sale->execute();
    $allSales = $sale->fetchAll(PDO::FETCH_OBJ);

  }else{
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';

}
if(isset($_GET['price'])){
    $price = $_GET['price'];

    $price_query = $conn->query("SELECT * FROM properties ORDER BY price $price");
    $price_query->execute();
    $allPrice = $price_query->fetchAll(PDO::FETCH_OBJ);
    // var_dump($allPrice);
    $category = $conn->query("SELECT * FROM categories");
    $category->execute();
    $allCategories = $category->fetchAll(PDO::FETCH_OBJ);

  }else{
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';

}
?>

<div class="site-loader"></div>

<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->

</div>
</div>


<div class="slide-one-item home-slider owl-carousel">
  <?php foreach ($properties as $property) : ?>
    <div class="site-blocks-cover overlay" style="background-image: url(images/<?php echo $property->image; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10">
            <span class="d-inline-block bg-<?php if ($property->type == "rent") {
                                              echo "success";
                                            } else {
                                              echo "danger";
                                            } ?> text-white px-3 mb-3 property-offer-type rounded"><?php echo $property->type; ?></span>
            <h1 class="mb-2"><?php echo $property->name; ?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo $property->price; ?></strong></p>
            <p><a href="property-details.php?id=<?php echo $property->id; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
          </div>
        </div>
      </div>
    </div> <?php endforeach; ?>


</div>


<div class="site-section site-section-sm pb-0">
  <div class="container">
    <div class="row">
      <form class="form-search col-md-12" method="POST" action="search.php" style="margin-top: -100px;">
        <div class="row  align-items-end">
          <div class="col-md-3">
            <label for="list-types">Listing Types</label>
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="types" id="list-types" class="form-control d-block rounded-0">
              <?php foreach($allCategories as $category): ?>
                <option value="<?php echo str_replace('-',' ',$category->name );?>"><?php echo str_replace('-',' ',$category->name );?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="offer-types">Offer Type</label>
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offers" id="offer-types" class="form-control d-block rounded-0">
                <option value="Sale">Sale</option>
                <option value="Rent">Rent</option>
                <option value="Lease">Lease</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="select-city">Select City</label>
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="cities" id="select-city" class="form-control d-block rounded-0">
                <option value="New York">New York</option>
                <option value="Brooklyn">Brooklyn</option>
                <option value="London">London</option>
                <option value="Japan">Japan</option>
                <option value="Philippines">Philippines</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <input type="submit" name="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
          </div>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
          <div class="mr-auto">
            <a href="index.php" class="icon-view view-module active"><span class="icon-view_module"></span></a>
          </div>
          <div class="ml-auto d-flex align-items-center">
            <div>
              <a href="http://localhost/homeland" class="view-list px-3 border-right active">All</a>
              <a href="rent.php?type=rent" class="view-list px-3 border-right">Rent</a>
              <a href="sale.php?type=sale" class="view-list px-3">Sale</a>
              <a href="price.php?price=ASC" class="view-list px-3">Price Ascending</a>
              <a href="price.php?price=DESC" class="view-list px-3">Price Decending</a>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="site-section site-section-sm bg-light">
  <div class="container">

    <div class="row mb-5">
      <?php foreach($allPrice as $allSale) : ?>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="property-entry h-100">
          <a href="property-details.html" class="property-thumbnail">
            <div class="offer-type-wrap">
              <span class="offer-type bg-<?php if($allSale->type=="rent"){echo "success";}else{echo "danger";} ?>"><?php echo $allSale->type; ?></span>
            </div>
            <img src="images/<?php echo $allSale->image; ?>" alt="Image" class="img-fluid">
          </a>
          <div class="p-4 property-body">
            <!-- <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a> -->
            <h2 class="property-title"><a href="property-details.php?id=<?php echo $allSale->id; ?>"><?php echo $allSale->name; ?></a></h2>
            <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $allSale->location; ?></span>
            <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $allSale->price; ?></strong>
            <ul class="property-specs-wrap mb-3 mb-lg-0">
              <li>
                <span class="property-specs">Beds</span>
                <span class="property-specs-number"><?php echo $allSale->beds; ?> <sup>+</sup></span>

                
              </li>
              <li>
                <span class="property-specs">Baths</span>
                <span class="property-specs-number"><?php echo $allSale->baths; ?></span>

              </li>
              <li>
                <span class="property-specs">SQ FT</span>
                <span class="property-specs-number"><?php echo $allSale->sq_ft; ?></span>

              </li>
            </ul>

          </div>
        </div>
      </div>
        <?php endforeach; ?>
     
    </div>


  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 text-center">
        <div class="site-section-title">
          <h2>Why Choose Us?</h2>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis maiores quisquam saepe architecto error corporis aliquam. Cum ipsam a consectetur aut sunt sint animi, pariatur corporis, eaque, deleniti cupiditate officia.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-house"></span>
          <h2 class="service-heading">Research Subburbs</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
          <p><span class="read-more">Read More</span></p>
        </a>
      </div>
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-sold"></span>
          <h2 class="service-heading">Sold Houses</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
          <p><span class="read-more">Read More</span></p>
        </a>
      </div>
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-camera"></span>
          <h2 class="service-heading">Security Priority</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
          <p><span class="read-more">Read More</span></p>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- <div class="site-section bg-light">
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
              <div class="site-section-title">
                <h2>Recent Blog</h2>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis maiores quisquam saepe architecto error corporis aliquam. Cum ipsam a consectetur aut sunt sint animi, pariatur corporis, eaque, deleniti cupiditate officia.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
              <a href="#"><img src="images/img_4.jpg" alt="Image" class="img-fluid"></a>
              <div class="p-4 bg-white">
                <span class="d-block text-secondary small text-uppercase">Jan 20th, 2019</span>
                <h2 class="h5 text-black mb-3"><a href="#">Art Gossip by Mike Charles</a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim, ipsa exercitationem veniam quae sunt.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="200">
              <a href="#"><img src="images/img_2.jpg" alt="Image" class="img-fluid"></a>
              <div class="p-4 bg-white">
                <span class="d-block text-secondary small text-uppercase">Jan 20th, 2019</span>
                <h2 class="h5 text-black mb-3"><a href="#">Art Gossip by Mike Charles</a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim, ipsa exercitationem veniam quae sunt.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="300">
              <a href="#"><img src="images/img_3.jpg" alt="Image" class="img-fluid"></a>
              <div class="p-4 bg-white">
                <span class="d-block text-secondary small text-uppercase">Jan 20th, 2019</span>
                <h2 class="h5 text-black mb-3"><a href="#">Art Gossip by Mike Charles</a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim, ipsa exercitationem veniam quae sunt.</p>
              </div>
            </div>

          </div>

        </div>
      </div> -->


<div class="site-section bg-light">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7">
        <div class="site-section-title text-center">
          <h2>Our Agents</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero magnam officiis ipsa eum pariatur labore fugit amet eaque iure vitae, repellendus laborum in modi reiciendis quis! Optio minima quibusdam, laboriosam.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
        <div class="team-member">

          <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded mb-4">

          <div class="text">

            <h2 class="mb-2 font-weight-light text-black h4">Megan Smith</h2>
            <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi dolorem totam non quis facere blanditiis praesentium est. Totam atque corporis nisi, veniam non. Tempore cupiditate, vitae minus obcaecati provident beatae!</p>
            <p>
              <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
              <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
              <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
            </p>
          </div>

        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
        <div class="team-member">

          <img src="images/person_2.jpg" alt="Image" class="img-fluid rounded mb-4">

          <div class="text">

            <h2 class="mb-2 font-weight-light text-black h4">Brooke Cagle</h2>
            <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cumque vitae voluptates culpa earum similique corrupti itaque veniam doloribus amet perspiciatis recusandae sequi nihil tenetur ad, modi quos id magni!</p>
            <p>
              <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
              <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
              <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
            </p>
          </div>

        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
        <div class="team-member">

          <img src="images/person_3.jpg" alt="Image" class="img-fluid rounded mb-4">

          <div class="text">

            <h2 class="mb-2 font-weight-light text-black h4">Philip Martin</h2>
            <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illo iusto, inventore, iure dolorum officiis modi repellat nobis, praesentium perspiciatis, explicabo. Atque cupiditate, voluptates pariatur odit officia libero veniam quo.</p>
            <p>
              <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
              <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
              <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
            </p>
          </div>

        </div>
      </div>



    </div>
  </div>
</div>
<?php require "includes/footer.php"; ?>