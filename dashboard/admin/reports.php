<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/Admin.model.php';
require_once '../../app/models/report.model.php';

$session = new Session();
$user = new Admin();
$report = new Report();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Reports</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/dashboard.min.css">
  <script type="text/javascript" src="<?= $_ENV['ROOT']; ?>/dist/lib/instascan/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>


  <main class="d-flex">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div>
        <a href="#" class="d-block text-center mt-3 mb-5">
          <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="First Mutual Logo" class="w-75">
        </a>
        <ul class="sidebar-nav nav flex-column">
          <li class="nav-item">
            <a href="./" class="nav-link"><i class="fas fa-home me-2"></i>Home</a>
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
            <a href="./reports.php" class="nav-link active"><i class="fas fa-chart-pie me-2"></i>Reports</a>
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
              <a href="./new-drug.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-boxes-stacked me-2"></i>Inventory</a>
              <a href="./new-drug.php" class="btn btn-primary btn-sm rounded-pill mx-2 d-none d-md-block"><i class="fas fa-user-group me-2"></i>User Accounts</a>
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
      <!-- End Of Header -->

      <div class="main-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="dashboard-alerts">
                <!-- Alerts go here -->
              </div>
            </div>
            <div class="col-lg-6">
              <section>
                <h3>Today's Reports</h3>
                <p class="fw-bold"><?= date('Y-m-d'); ?></p>
                <div class="">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">Total Sales</th>
                        <td>USD$ <?= $report->dailySales(date('Y-m-d')); ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Number Of Sales</th>
                        <td><?= $report->numberOfSales(date('Y-m-d')); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>
            </div>
            <div class="col-lg-6">
              <section>
                <h3>Other Statistics</h3>
                <div class="">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">Registered Customers</th>
                        <td><?= $report->totalUsers(); ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Customers With Medical Aid</th>
                        <td><?= $report->usersWithMedicalAid(); ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Number Of Products</th>
                        <td><?= $report->numberOfStockItems(); ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Products In Low</th>
                        <td><?= $report->numberOfItemsInLowStock(); ?> / <?= $report->numberOfStockItems(); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>
            </div>
            <div class="col-lg-6">
              <section>
                <canvas id="salesChart">

                </canvas>
              </section>
            </div>
            <div class="col-lg-6">
              <section>
                <canvas id="salesNumbersChart">

                </canvas>
              </section>
            </div>
            <div class="col-lg-6">
              <section>
                <h3>Sales</h3>
                <?php
                $dailySales = $report->dailySales();

                foreach ($dailySales as $day) {
                ?>
                  <p class="fw-bold"><?= $day['sale_date']; ?></p>
                  <div class="">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th scope="row">Total Sales</th>
                          <td>USD$ <?= $day['sum']; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Number Of Sales</th>
                          <td><?= $report->numberOfSales($day['sale_date']); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php
                }
                ?>
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
  <script type="text/javascript">
    $(document).ready(function() {

    let salesChart = new Chart(document.getElementById('salesChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: [<?php foreach ($dailySales as $day) {
                    echo "'" . $day['sale_date'] .  "', ";
                  } ?>],
        datasets: [{
          label: 'Daily Sales ($USD)',
          data: [<?php foreach ($dailySales as $day) {
                    echo $day['sum'] . ', ';
                  } ?>],
          borderColor: 'green',
          backgroundColor: 'green'
        }]
      }
    });

    let salesNumbersChart = new Chart(document.getElementById('salesNumbersChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: [<?php foreach ($dailySales as $day) {
                    echo "'" . $day['sale_date'] .  "', ";
                  } ?>],
        datasets: [{
          label: 'Numbers Of Sales',
          data: [<?php foreach ($dailySales as $day) {
                    echo  $report->numberOfSales($day['sale_date']) . ', ';
                  } ?>],
          borderColor: 'red',
          backgroundColor: 'red'
        }]
      }
    });


    });
  </script>
</body>

</html>