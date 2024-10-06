<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/admin.model.php';
require_once '../../app/models/stock.model.php';

$session = new Session();
$user = new Admin();
$stock = new Stock();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Admin -> Stock</title>
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
    <!-- Sidebar -->
    <aside class="sidebar">
      <div>
        <a href="./" class="d-block text-center mt-3 mb-5">
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
                  <a href="./products.php" class="nav-link active">Products</a>
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
            <div class="col-12">
              <div class="dashboard-alerts">
                <!-- Alerts here -->
                <?php
                if (isset($_POST['newProductForm'])) {
                  $formData = $_POST;
                  $formData['stock_id'] = generateId('stc_');
                  //$formData['balance'] = 0;
                  if ($stock->addDrug($formData)) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> New product added successfully! <b><?= $formData['stock_id']; ?></b>.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> New product couldn't be added!</b>.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
            <div class="col-md-8">
              <section>
                <div class="d-flex justify-content-between mb-3">
                  <h4>Stock</h4>

                  <form id="stockSearchForm" action="">
                    <div class="input-group">
                      <input type="text" name="q" id="q" class="form-control form-control-sm" placeholder="Search Stock">
                      <div class="input-group-text p-0">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

                <table id="stockTable" class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">Name</th>
                      <th scope="col" colspan="3">Description</th>
                      <th scope="col">Threshold</th>
                      <th scope="col">Balance</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td>1</td>
                      <td>Paracetamol</td>
                      <td colspan="3">White round tablet (20mg packaging)</td>
                      <td>12</td>
                      <td>10</td>
                      <td><button class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></button></td>
                    </tr> -->
                    <?php
                    $currentStock = $stock->getAllDrugs();
                    if ($currentStock !== false) {
                      foreach ($currentStock as $stockItem) {
                    ?>
                        <tr class="">
                          <th scope="row"><?= $stockItem['stock_id']; ?></th>
                          <td><?= $stockItem['name']; ?></td>
                          <td colspan="3"><?= $stockItem['description']; ?></td>
                          <td><?= $stockItem['threshold']; ?></td>
                          <td><?= $stockItem['balance']; ?></td>
                          <td>
                            <?php
                            if ($stockItem['balance'] < $stockItem['threshold']) {
                              if ($stockItem['balance'] > 0) {
                                echo '<span class="text-warning fw-bold"><i class="fas fa-triangle-exclamation"></i> Low</span>';
                              } else {
                                echo '<span class="text-danger fw-bold"><i class="fas fa-circle-xmark"></i> Out of stock</span>';
                              }
                            }
                            ?>
                          </td>
                          <td>
                            <button class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></button>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="6" class="text-center">No Drugs Available</td>
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
            <div class="col-md-4">
              <section class="customers p-4">
                <h3 class="mb-3">New Stock Item</h3>
                <form id="newProductForm" action="" method="post">
                  <div class="form-group mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="description" class="form-label">Product Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Product Description" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="threshold" class="form-label">Threshold</label>
                    <input type="number" name="threshold" id="threshold" class="form-control" placeholder="Threshold" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="Balance" class="form-label">Initial Balance</label>
                    <input type="number" name="Balance" id="Balance" class="form-control" placeholder="Balance" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                      <div class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                      <input type="number" name="price" id="price" class="form-control" placeholder="Product Name" step="0.01" min="0" required>
                    </div>
                  </div>
                  <hr class="my-3">
                  <div class="form-group">
                    <!-- Hidden -->
                    <input type="hidden" name="newProductForm" value="newProductForm">
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
  <script>
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

    });
  </script>
</body>

</html>