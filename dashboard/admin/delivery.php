<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/admin.model.php';
require_once '../../app/models/stock.model.php';
require_once '../../app/models/qr.model.php';
require_once '../../app/models/sales.model.php';

$session = new Session();
$user = new Admin();
$stock = new Stock();
$qr = new QR();
$sales = new Sales();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | POS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>/dist/css/dashboard.min.css">
  <script type="text/javascript" src="<?= $_ENV['ROOT']; ?>/dist/lib/instascan/instascan.min.js"></script>

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
            <a href="#" class="nav-link active" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"><i class="fas fa-box me-2"></i>Stock <i class="fa fa-angle-right"></i></a>
            <div class="collapse" id="collapse1">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="./products.php" class="nav-link">Products</a>
                </li>
                <li class="nav-item">
                  <a href="./delivery.php" class="nav-link active">New Delivery</a>
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
                  <a href="./customers.php" class="nav-link ">Customers</a>
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
      <!-- End Of Header -->


      <div class="main-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="dashboard-alerts">
                <!-- Alerts go here -->
              </div>
            </div>
            <div class="col-lg-9">
              <section>
                <div class="d-flex justify-content-between mb-3">
                  <h4>Stock Deliveries</h4>

                  <form id="stockSearchForm" action="">
                    <div class="input-group">
                      <input type="text" name="q" id="q" class="form-control form-control-sm" placeholder="Search Stock">
                      <div class="input-group-text p-0">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

                <table id="stockTable" class="table">
                  <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">#ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Supplier</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Current Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $entries = $stock->getAllStockEntries();
                    if ($entries !== false) {
                      foreach ($entries as $stockEntry) {
                        $stockEntryData = $stock->getDrug($stockEntry['stock_id']);
                    ?>
                        <tr>
                          <th scope="row"><?= $stockEntry['date']; ?></th>
                          <td><?= $stockEntry['stock_id']; ?></td>
                          <td><?= $stockEntryData['name']; ?></td>
                          <td><?= $stockEntry['supplier']; ?></td>
                          <td><?= $stockEntry['amount']; ?></td>
                          <td><?= $stockEntryData['balance']; ?></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="6" class="text-center">No Deliveries Available</td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>

              </section>
            </div>
            <div class="col-lg-3">
              <section>
                <h4>Add New Stock</h4>
                <form id="addStockForm">
                  <label for="stock_id" class="form-label">StockID</label>
                  <div class="input-group mb-2">
                    <input type="text" name="stock_id" id="stock_id" class="form-control" placeholder="StockID">
                  </div>
                  <label for="supplier" class="form-label">Supplier</label>
                  <div class="input-group mb-2">
                    <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Supplier">
                  </div>
                  <label for="amount" class="form-label">Amount</label>
                  <div class="input-group mb-2">
                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                  </div>
                  <!-- Hidden -->
                  <input type="hidden" name="add_stock" value="add_stock">
                  <hr class="bg-primary">
                  <div class="input-group my-2">
                    <button type="submit" class="btn btn-primary w-100">Complete</button>
                  </div>
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
  <script type="text/javascript">
    $(document).ready(function() {

      const stockContainer = $('#stockTable tbody');
      const alertsContainer = $('.dashboard-alerts');

      // Get searched stock
      $('#stockSearchForm').on('submit', (e) => {
        e.preventDefault();

        $.ajax({
          url: `<?= $_ENV['ROOT']; ?>app/services/search-stock.php`,
          type: 'POST',
          dataType: 'html',
          data: {
            q: $('#stockSearchForm input[name=q]').val(),
            search_stock: "search_stock"
          },
          success: function(htmlData) {
            //console.log('Success ajax');
            stockContainer.html(htmlData);
          }
        });
      });

      // Add new stock
      $('#addStockForm').on('submit', (e) => {
        e.preventDefault();

        //console.log($('#addStockForm').serialize());
        $.ajax({
          url: `<?= $_ENV['ROOT']; ?>app/services/add-stock.php`,
          type: 'POST',
          dataType: 'html',
          data: $('#addStockForm').serialize(),
          success: function(htmlData) {
            console.log(htmlData);
            alertsContainer.html(htmlData);
          }
        });
      });

    });
  </script>
</body>

</html>