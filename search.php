<?php

require "includes/header.php";
require "config/config.php";

$select = $conn->query("SELECT * FROM properties");
$select->execute();
$properties = $select->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    $types = $_POST['types'];
    $offers = $_POST['offers'];
    $cities = $_POST['cities'];

    $search = $conn->query("SELECT * FROM properties WHERE home_type LIKE '%$types%' OR type LIKE '%$offers%' 
    OR location LIKE '%$cities%'");
    $search->execute();

    $listings = $search->fetchAll(PDO::FETCH_OBJ);

}else{
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland">';

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
        </div> 
    <?php endforeach; ?>


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
                                <option value="condo">Condo</option>
                                <option value="commercial Building">Commercial Building</option>
                                <option value="land Property">Land Property</option>
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
    </div>
</div>

<div class="site-section site-section-sm bg-light">
    <div class="container">

        <div class="row mb-5">
            <?php if (count($listings) > 0) : ?>
                <?php foreach ($listings as $listing) : ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="property-entry h-100">
                            <a href="property-details.php?id=<?php echo $listing->id; ?>" class="property-thumbnail">
                                <div class="offer-type-wrap">
                                    <span class="offer-type bg-<?php if ($listing->type == "rent") {
                                                                    echo "success";
                                                                } else {
                                                                    echo "danger";
                                                                } ?>"><?php echo $listing->type; ?></span>
                                </div>
                                <img src="images/<?php echo $listing->image; ?>" alt="Image" class="img-fluid">
                            </a>
                            <div class="p-4 property-body">
                                <!-- <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a> -->
                                <h2 class="property-title"><a href="property-details.php?id=<?php echo $listing->id; ?>"><?php echo $listing->name; ?></a></h2>
                                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 625 S. Berendo St Unit 607 Los Angeles, CA 90005</span>
                                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $listing->price; ?></strong>
                                <ul class="property-specs-wrap mb-3 mb-lg-0">
                                    <li>
                                        <span class="property-specs">Beds</span>
                                        <span class="property-specs-number"><?php echo $listing->beds; ?><sup>+</sup></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">Baths</span>
                                        <span class="property-specs-number"><?php echo $listing->baths; ?></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">SQ FT</span>
                                        <span class="property-specs-number"><?php echo $listing->sq_ft; ?></span>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="bg-success text-white"> we don't have any record for your search for now </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php require "includes/footer.php"; ?>