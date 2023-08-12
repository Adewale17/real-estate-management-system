<?php
require "../includes/header.php";
require "../server.php";



?>


 


  <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(http://localhost/homeland/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-10">
          <h1 class="mb-2">Register</h1>
        </div>
      </div>
    </div>
  </div>


  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
          <h3 class="h4 text-black widget-title mb-3">Register</h3>
          <form action="" class="form-contact-agent" method="post">
            <?php require_once "../includes/error.php"; ?>
            <div class="form-group">
              <label for="email">Username</label>
              <input type="text" name="username" id="username" class="form-control w-50">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control w-50">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control w-50">
              <i class="bi bi-eye-slash" id="togglePassword"></i>
            </div>
            <div class="form-group">
              <input type="submit" name="register" id="phone" class="btn btn-primary" value="Register">
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php require_once "../includes/footer.php"; ?>