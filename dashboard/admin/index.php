<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/admin.model.php';
require_once '../../app/models/stock.model.php';
require_once '../../app/models/report.model.php';

$session = new Session();
$user = new Admin();
$stock = new Stock();
$report = new Report();



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/dashboard.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>


  <main class="d-flex">
    <!-- Sidebar -->
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
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"><i class="fas fa-box me-2"></i>Stock <i class="fa fa-angle-right"></i></a>
            <div class="collapse" id="collapse1">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="./products.php" class="nav-link">Products</a>
                </li>
                <li class="nav-item">
                  <a href="./delivery.php" class="nav-link">New Delivery</a>
                </li>
                <li class="nav-item">
                  <a href="./stock-entries.php" class="nav-link">Stock Entries</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false"><i class="fas fa-user-group me-2"></i>Users <i class="fa fa-angle-right"></i></a>
            <div class="collapse" id="collapse2">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="./customers.php" class="nav-link">Customers</a>
                </li>
                <li class="nav-item">
                  <a href="./staff.php" class="nav-link">Staff</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a href="./reports.php" class="nav-link"><i class="fas fa-chart-pie me-2"></i>Reports</a>
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
    <!-- End Of Sidebar -->

    <div class="main">
      <!-- Header -->
      <nav id="header" class="navbar">
        <div class="container-fluid">
          <div class="row justify-content-between w-100">
            <div class="col d-flex align-items-center">
              <button class="sidebar-toggle btn d-md-none"><i class="fa fa-bars"></i></button>
              <a href="./reports.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-chart-line me-2"></i>View Reports</a>
              <a href="./products.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-boxes-stacked me-2"></i>Inventory</a>
              <a href="./customers.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-user-group me-2"></i>User Accounts</a>
            </div>
            <div class="col">
              <ul class="nav align-items-center justify-content-end">
                <li class="nav-item">
                  <span class="fw-bold">Admin</span>
                </li>
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
      <!-- End Of Header -->

      <div class="main-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-9">
              <section class="welcome p-3">
                <h2>Welcome <?= $_SESSION['firstname']; ?></h2>
                <p>Good day administrator <?= $_SESSION['firstname']; ?>, welcome back to the health portal</p>
                <a href="<?= $_ENV['ROOT']; ?>dashboard/staff/pos.php" class="btn btn-primary">View Reports</a>
              </section>
            </div>
            <div class="col-lg-3">
              <section class="total-sales text-center p-2">
                <h2>Today's Sales</h2>
                <hr class="m-3 py-1 bg-primary text-primary">
                <h3>USD$ <?= $report->dailySales(date('Y-m-d')); ?></h3>
              </section>
            </div>
            <div class="col-lg-6">
              <section>
                <h4 class="mb-3">Notifications</h4>
                <?php
                $drugsOutOfStock = $stock->outOfStockDrugs();

                if ($drugsOutOfStock !== false) {
                  foreach ($drugsOutOfStock as $drugOutOfStock) {
                ?>
                    <div class="alert alert-danger bg-primary text-white alert-dismissible fade show p-2" role="alert">
                      <i class="fa fa-circle-xmark me-2"></i> <?= $drugOutOfStock['name']; ?> is out of stock.
                    </div>
                  <?php
                  }
                }

                $drugsInLowStock = $stock->drugsBelowThreshold();

                if ($drugsInLowStock !== false) {
                  foreach ($drugsInLowStock as $drugInLowStock) {
                  ?>
                    <div class="alert alert-warning alert-dismissible fade show p-2" role="alert">
                      <i class="fa fa-exclamation-triangle me-2"></i> <?= $drugInLowStock['name']; ?> is low in stock.
                    </div>
                <?php
                  }
                }
                ?>
              </section>
            </div>
            <div class="col-lg-6">
              <section>
                <?php
                $popularProducts = $report->stockByPopularity(5);
                ?>
                <canvas id="popularProductsChart">
                  
                </canvas>
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

      // Search Availability Form
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


      // Popular Meds Chart
      let popularProductsChart = new Chart(document.getElementById('popularProductsChart').getContext('2d'), {
        type: 'bar',
        data: {
          labels: [<?php foreach ($popularProducts as $popular) { echo "'" . $popular['stock_id'] . "', ";}?>],
          datasets: [{
            label: 'Popular Products',
            data: [<?php foreach ($popularProducts as $popular) { echo "'" . $popular['quantity'] . "', ";}?>],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true

            }
          }
        }
      });
    });
  </script>
</body>

</html>