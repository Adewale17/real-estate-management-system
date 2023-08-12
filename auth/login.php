<?php

require "../includes/header.php";
require "../server.php";

//session validation for login page 


?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(../images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Login</h1>
      </div>
    </div>
  </div>
</div>
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




<div class="site-section ">
  <div class="container  ">
    <div class="row ">
      <div class="col-md-12" data-aos="fade-up" data-aos-delay="100" >
        <h3 class="h4 text-black widget-title mb-3">Login</h3>
        <?php require "../includes/error.php"; ?>
        <form action="login.php" class="form-contact-agent " method="POST">

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control w-50">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control  w-50">
          </div>
         
          <div class="form-group">
          <!-- <div class="col-md-6 offset-md-4"> -->
             
           
      <!-- </div> -->
            <input type="submit" name="login" id="phone" class="btn btn-primary" value="Login">
            <a href="http://localhost/homeland/login-system-main/recover_psw.php" class="btn btn-link">Forgot Your Password? </a>
            
          </div>
          
        </form>
      </div>

    </div>
  </div>
</div>




<?php require_once "../includes/footer.php"; ?>