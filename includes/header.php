<?php 
  session_start(); 
  require dirname(dirname(__FILE__))."/config/config.php";

  $category = $conn->query("SELECT * FROM categories");
  $category->execute();
  $allCategories = $category->fetchAll(PDO::FETCH_OBJ);

  
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Homeland &mdash; Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="http://localhost/homeland/fonts/icomoon/style.css">

    <link rel="stylesheet" href="http://localhost/homeland/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/magnific-popup.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/jquery-ui.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/owl.carousel.min.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/mediaelementplayer.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/animate.css">
    <link rel="stylesheet" href="http://localhost/homeland/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="http://localhost/homeland/css/fl-bigmug-line.css">
    
  
    <link rel="stylesheet" href="http://localhost/homeland/css/aos.css">

    <link rel="stylesheet" href="http://localhost/homeland/css/style.css">
   
    
  </head>
  
  <body>
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

    <div class="site-navbar mt-4">
    <div class="container py-1">
      <div class="row align-items-center">
        <div class="col-8 col-md-8 col-lg-4">
          <h1 class="mb-0"><a href="http://localhost/homeland/index.php" class="text-white h2 mb-0"><strong>Homeland<span class="text-danger">.</span></strong></a></h1>
        </div>
        <div class="col-4 col-md-4 col-lg-8">
          <nav class="site-navigation text-right text-md-right" role="navigation">

            <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

            <ul class="site-menu js-clone-nav d-none d-lg-block">
             
              <li class="active">
                <a href="http://localhost/homeland/index.php">Home</a>
              </li>
              <li><a href="http://localhost/homeland/sale.php?type=rent">Rent</a></li>
              <li><a href="http://localhost/homeland/rent.php?type=sale">Buy</a></li>
              <li class="has-children">
                <a href="#">Properties</a>
                <ul class="dropdown arrow-top">
                <?php foreach($allCategories as $allcategory): ?>
                  <li><a href="http://localhost/homeland/categories/category.php?name=<?php echo $allcategory->name;?>"><?php echo str_replace('-', ' ',$allcategory->name);?> </a></li>
                 <?php endforeach; ?>
                  
                </ul>
              </li>
              <li><a href="http://localhost/homeland/about.php">About</a></li>
                <li><a href="http://localhost/homeland/contact.php">Contact</a></li>
              <?php if(isset($_SESSION['username'])): ?>
              <li class="has-children">
                <a href="http://localhost/homeland/property-detail.php"><?php echo $_SESSION['username'] ?></a>
                <ul class="dropdown arrow-top">
                  <li><a href="http://localhost/homeland/user/favourites.php">Favourites</a></li>
                  <li><a href="http://localhost/homeland/user/requests.php">Requests</a></li>
                  <li><a href="http://localhost/homeland/auth/logout.php">Logout</a></li>
                  
                </ul>
              </li>
              <?php else:?>
              
              <li><a href="http://localhost/homeland/auth/login.php">Login</a></li>
              <li><a href="http://localhost/homeland/auth/register.php">Register</a></li>
            </ul>
          </nav>
        </div>
        <?php endif;?>


      </div>
    </div>
  </div>
  </div>