<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/staff.model.php';
require_once '../../app/models/stock.model.php';
require_once '../../app/models/qr.model.php';

$session = new Session();
$user = new Staff();
$stock = new Stock();
$qr = new QR();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Staff</title>
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
        <a href="./" class="d-block text-center mt-3 mb-5">
          <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="First Mutual Logo" class="w-75">
        </a>
        <ul class="sidebar-nav nav flex-column">
          <li class="nav-item">
            <a href="./" class="nav-link active"><i class="fas fa-home me-2"></i>Home</a>
          </li>
          <li class="nav-item">
            <a href="./pos.php" class="nav-link"><i class="fas fa-cart-shopping me-2"></i>Pos</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"><i class="fas fa-box me-2"></i>Stock <i class="fa fa-angle-right"></i></a>
            <div class="collapse" id="collapse1">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="./availability.php" class="nav-link">Check Availability</a>
                </li>
                <li class="nav-item">
                  <a href="./current-stock.php" class="nav-link">Current Stock</a>
                </li>
                <li class="nav-item">
                  <a href="./current-stock.php" class="nav-link">New Delivery</a>
                </li>
                <li class="nav-item">
                  <a href="./stock-entries.php" class="nav-link">Stock Entries</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a href="./reports.php" class="nav-link"><i class="fas fa-chart-pie me-2"></i>Reports</a>
          </li>
          <li class="nav-item">
            <a href="./prescriptions.php" class="nav-link"><i class="fas fa-prescription me-2"></i>Prescriptions</a>
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
              <a href="./pos.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fa fa-circle-play me-2"></i>Start Dispensing</a>
              <a href="./availability.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fa fa-eye me-2"></i>Check Availability</a>
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
            <div class="col-12 text-end py-2">
              <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>New</a>
              <a href="#" class="btn btn-sm btn-success"><i class="fa fa-question-circle"> </i></a>
            </div>
            <div class="col-9">
              <section class="welcome p-3">
                <h2>Welcome <?= $_SESSION['firstname']; ?></h2>
                <p>Good day <?= $_SESSION['firstname']; ?>, welcome back to the health portal</p>
                <a href="<?= $_ENV['ROOT']; ?>dashboard/staff/pos.php" class="btn btn-primary">Start Dispensing</a>
              </section>
            </div>
            <div class="col-3">
              <section class="total-sales text-center p-2">
                <h2>Current Queue</h2>
                <hr class="my-3 bg-secondary">
                <h3><?= $_SESSION['queue']; ?></h3>
              </section>
            </div>
            <div class="col-6">
              <section>

              </section>
            </div>
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