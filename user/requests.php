<?php

    require "../includes/header.php";
    require "../config/config.php";

    $favs = $conn->query("SELECT properties.id AS id, properties.name AS name, properties.location AS location,
     properties.price AS price, properties.image AS image, properties.beds AS beds, properties.baths AS baths, 
     properties.sq_ft AS sq_ft, properties.home_type AS home_type, properties.year_built AS year_built,
      properties.type AS type, properties.price_sqft AS price_sqft FROM properties 
      JOIN requests ON properties.id = requests.property_id WHERE requests.user_id = '$_SESSION[user_id]'");
    $favs->execute();
    $properties  = $favs->fetchAll(PDO::FETCH_OBJ);


?>




</div>
<div class="site-wrap">

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(../images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">Your Requests</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row mb-5 mt-5">
            <?php if(count($properties) > 0) : ?>
             <?php foreach ($properties as $property) : ?>
                <div class="col-md-6 col-lg-4 mb-4 mt-5" >
                    <div class="property-entry h-100">
                        <a href="http://localhost/homeland/property-details.php?id=<?php echo $property->id; ?>" class="property-thumbnail">
                            <div class="offer-type-wrap">
                                <span class="offer-type bg-<?php if ($property->type == "rent") {
                                                                echo "success";
                                                            } else {
                                                                echo "danger";
                                                            } ?>"><?php echo $property->type; ?></span>
                            </div>
                            <img src="http://localhost/homeland/images/<?php echo $property->image; ?>" alt="Image" class="img-fluid">
                        </a>
                        <div class="p-4 property-body">
                            <!-- <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a> -->
                            <h2 class="property-title"><a href="http://localhost/homeland/property-details.php?id=<?php echo $property->id; ?>"><?php echo $property->name; ?></a></h2>
                            <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $property->location; ?></span>
                            <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $property->price; ?></strong>
                            <ul class="property-specs-wrap mb-3 mb-lg-0">
                                <li>
                                    <span class="property-specs">Beds</span>
                                    <span class="property-specs-number"><?php echo $property->beds; ?> <sup>+</sup></span>


                                </li>
                                <li>
                                    <span class="property-specs">Baths</span>
                                    <span class="property-specs-number"><?php echo $property->baths; ?></span>

                                </li>
                                <li>
                                    <span class="property-specs">SQ FT</span>
                                    <span class="property-specs-number"><?php echo $property->sq_ft; ?></span>

                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
                 <div class="bg-primary text-white">
                 <p> You have not request for any property </p>
                 </div>
            <?php endif ?>
        </div>


    </div>
</div>
<?php    require "../includes/footer.php"; ?>