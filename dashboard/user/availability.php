<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/user.model.php';
require_once '../../app/models/stock.model.php';
require_once '../../app/models/prescription.model.php';

$session = new Session();
$user = new User();
$stock = new Stock();
$prescription = new Prescription();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | User</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/dashboard.min.css">
</head>

<body>


  <main class="d-flex">
    <aside class="sidebar">
      <div>
        <a href="#" class="d-block text-center mt-3 mb-5">
          <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="First Mutual Logo" class="w-75">
        </a>
        <ul class="sidebar-nav nav flex-column">
          <li class="nav-item">
            <a href="./" class="nav-link active"><i class="fas fa-home me-2"></i>Home</a>
          </li>
          <li class="nav-item">
            <a href="./reports.php" class="nav-link"><i class="fas fa-hospital me-2"></i>Prescriptions</a>
          </li>
          <li class="nav-item">
            <a href="./reports.php" class="nav-link"><i class="fas fa-check-circle me-2"></i>Availability</a>
          </li>
          <li class="nav-item">
            <a href="./reports.php" class="nav-link"><i class="fas fa-hospital me-2"></i>Medical Aid</a>
          </li>
          <li class="nav-item">
            <a href="./settings.php" class="nav-link"><i class="fas fa-cog me-2"></i>Settings</a>
          </li>
        </ul>

      </div>
      <div class="p-3">
        <a href="<?= $_ENV['ROOT']; ?>dashboard/logout.php" class="btn btn-outline-primary w-100 text-white"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
      </div>
      <button class="sidebar-close btn"><i class="fas fa-angle-left"></i></button>
    </aside>

    <div class="main">
      <nav id="header" class="navbar">
        <div class="container-fluid">
          <div class="row justify-content-between w-100">
            <div class="col d-flex align-items-center">
              <button class="sidebar-toggle btn d-md-none"><i class="fa fa-bars"></i></button>
              <a href="./reports.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-pen me-2"></i>Update Details</a>
              <a href="./new-drug.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-check-circle me-2"></i>Check Availability</a>
            </div>
            <div class="col">
              <ul class="nav align-items-center justify-content-end">
                <li class="nav-item">
                  <a href="./notifications.php" class="nav-link"><i class="fa fa-bell"></i></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../../dist/img/user.png" class="header-user-profile" alt="" width="25px" height="25px">
                    <span class="ms-2 fw-bold"><?= $_SESSION['firstname']; ?></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="./settings.php"><i class="fa fa-user me-2"></i>User Profile</a></li>
                    <li><a class="dropdown-item" href="./settings.php"><i class="fa fa-cog me-2"></i>Settings</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-center" href="../logout.php"><i class="fa fa-right-from-bracket me-2"></i>Logout</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="main-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-6">
              <section class="availability p-5">
                <h3 class="text-center">Check Drug Availability</h3>
                <form id="checkAvailabilityForm" action="">
                  <div class="input-group">
                    <select name="q" id="q" class="form-select form-select-lg">
                      <?php
                      $drugs = $stock->getAllDrugs();

                      if ($drugs !== false) {
                        foreach ($drugs as $stockItem) {
                      ?>
                          <option value='{"stock_id": "<?= $stockItem['stock_id']; ?>", "name": "<?= $stockItem['name']; ?>", "isLow": <?= $stock->drugIsBelowThreshold($stockItem['stock_id']); ?>, "isAvailable": <?= $stock->drugIsAvailable($stockItem['stock_id']); ?>}'><?= $stockItem['name']; ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                    <button type="submit" class="btn btn-lg btn-primary px-4">Search</button>
                  </div>
                  <p class="search-result-container p-3 fw-bold text-center"></p>
                </form>
              </section>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>


  <script src="<?= $_ENV['ROOT']; ?>/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>/dist/js/dashboard.js"></script>
  <script>
    $(document).ready(function() {
      const searchAvailabilityForm = $('#checkAvailabilityForm');
      const resultsContainer = $('.search-result-container');
      searchAvailabilityForm.on('submit', (e) => {
        e.preventDefault();

        let details = JSON.parse($('#checkAvailabilityForm select').val());

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