<?php

require_once './vendor/autoload.php';
require_once './app/config/config.php';
require_once './app/models/db.model.php';
require_once './app/models/stock.model.php';

$stock = new Stock();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>First Mutual Pharmacy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist/css/style.min.css">
</head>

<body>



  <nav id="header" class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= $_ENV['ROOT']; ?>">
        <img src="./dist/img/first-mutual-logo.svg" alt="" width="150px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#hero">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#availability">Availability</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $_ENV['ROOT']; ?>faq.php">FAQ</a>
          </li>
        </ul>
        <a href="<?= $_ENV['ROOT']; ?>dashboard/login.php" class="btn btn-primary">Login</a>
      </div>
    </div>
  </nav>


  <main>
    <section id="hero" class="hero my-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2>First Mutual Pharmacy</h2>
            <p> Your trusted source for affordable healthcare, conveniently online.</p>
            <a href="<?= $_ENV['ROOT']; ?>registration.php" class="btn btn-primary">Register Now</a>
          </div>
          <div class="col-lg-6 text-center">
            <img src="./dist/img/doctor.png" alt="" class="img-fluid w-75">
          </div>
        </div>
      </div>
    </section>

    <section class="offerings">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4">
            <div class="offerings-container">
              <span class="offerings-icon ">
                <i class="far fa-address-card"></i>
              </span>
              <div class="px-2">
                <h4 class="mb-0">QR Card</h4>
                <p class="text-white mb-0">No line, just use a pharmacy card</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="offerings-container">
              <span class="offerings-icon ">
                <i class="far fa-clock"></i>
              </span>
              <div class="px-2">
                <h4 class="mb-0">Visiting Hours</h4>
                <p class="text-white mb-0">Mon -Fri ~ 08:00-16:30 </p>
                <p class="text-white mb-0">Sat ~ 08:00-13:30 </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="offerings-container">
              <span class="offerings-icon">
                <i class="fas fa-prescription-bottle"></i>
              </span>
              <div class="px-2">
                <h4 class="mb-0">Prescriptions</h4>
                <p class="text-white mb-0">Keep all your prescriptions in one place</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="services">
      <div class="container">
        <div class="row">

        </div>
      </div>
    </section>

    <section id="availability" class="availability my-4">
      <div class="container rounded-3">
        <div class="row">
          <div class="col-md-6 p-5">
            <h3>Check Product Availability</h3>
            <p>Use this to check if the products you need are in stock!</p>
            <form id="searchAvailabilityForm" action="">
              <div class="input-group">
                <select name="q" id="q" class="form-select form-select-lg">
                  <?php
                  $drugs = $stock->getAllDrugs();

                  if ($drugs !== false) {
                    foreach ($drugs as $stockItem) {
                  ?>
                      <option value='{"stock_id": "<?= $stockItem['stock_id']; ?>}", "name": "<?= $stockItem['name']; ?>", "isLow": <?= $stock->drugIsBelowThreshold($stockItem['stock_id']); ?>, "isAvailable": <?= $stock->drugIsAvailable($stockItem['stock_id']); ?>}'><?= $stockItem['name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
                <button type="submit" class="btn btn-lg btn-primary px-4">Search</button>
              </div>
            </form>
            <p class="search-result-container p-3 fw-bold text-center"></p>
          </div>
          <div class="col-md-6" style="background: url('./dist/img/pills.jpg') center/cover;">

          </div>
        </div>
      </div>
    </section>


    <div class="contact my-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="contact-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3745.4610041539604!2d28.57837677500672!3d-20.15652208128343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1eb554760bbc644f%3A0xc952dd63e6a31c9d!2sBulawayo%20Centre!5e0!3m2!1sen!2szw!4v1727026921286!5m2!1sen!2szw" width="100%" height="375" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
          <div class="col-md-6 p-4">
            <h10>Leading expertise</h10>
            <h2>A team of experts will design your treatment plan</h2>
            <p>Your First Mutual care team includes the best specialists in every medical field you need, focused on you. No matter what serious or complex health challenge you're facing, you can be confident that you're receiving the most advanced care at Mayo Clinic.</p>
            <h6>Top-ranked in Zimbabwe</h6>
            <p>First Mutual has more No. 1 rankings than any other pharmacy in the nation</p>

            <button type="button" class="btn btn-outline-danger text-center">Why choose us.</button>
          </div>
        </div>
      </div>
    </div>

    <section class="callout py-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8">
            <h3>Do you have questions?</h3>
            <p class="text-white">Check out the FAQ and Information center for any details and information on how to use this web system!</p>
          </div>
          <div class="col-lg-4 text-lg-center">
            <a href="./faq.php" class="btn btn-lg btn-primary px-3">Information Center</a>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer py-3">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p class="text-white text-center small m-0"><i class="far fa-copyright text-primary"></i> All right reserved</p>
          </div>
        </div>
      </div>
    </footer>
  </main>


  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./dist/js/main.js"></script>
  <script>
    $(document).ready(function() {
      const searchAvailabilityForm = $('#searchAvailabilityForm');
      const resultsContainer = $('.search-result-container');
      searchAvailabilityForm.on('submit', (e) => {
        e.preventDefault();

        let details = JSON.parse($('#searchAvailabilityForm select').val());

        if (details.isAvailable === 1) {
          if (details.isLow === 1) {
            resultsContainer.html(`<span class="text-warning"><i class="fas fa-triangle-exclamation me-2"></i>${details.name} is low in stock</span>`);
          } else {
            resultsContainer.html(`<span class="text-success"><i class="fas fa-circle-check me-2"></i>${details.name} is available</span>`);
          }
        } else {
          resultsContainer.html(`<span class="text-danger"><i class="fas fa-triangle-exclamation me-2"></i>${details.name} is out of stock</span>`)
        }

      });
    });
  </script>
</body>

</html>