<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/admin.model.php';
require_once '../../app/models/stock.model.php';

$db = new Database();
$session = new Session();
$user = new Admin();
$stock = new Stock();


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
            <a href="#" class="nav-link active" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false"><i class="fas fa-user-group me-2"></i>Users <i class="fa fa-angle-right"></i></a>
            <div class="collapse" id="collapse2">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="./customers.php" class="nav-link active">Customers</a>
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

      <div class="main-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="dashboard-alerts">
                <!-- Alerts here -->

                <?php

                if (isset($_POST['registerUserForm'])) {
                  $db->connect();
                  do {
                    $userId = generateId('usr_');
                    $sql = "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'";
                    $result = mysqli_query($db->db_conn, "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'");
                  } while (mysqli_num_rows($result) > 0);

                  $username = strtolower($_POST['firstname']) . strtolower($_POST['surname']);
                  $_POST['date'] = '1990-01-01';
                  $stmt = mysqli_prepare($db->db_conn, "INSERT INTO tbl_users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                  mysqli_stmt_bind_param($stmt, 'ssssssssss', $userId, $username, $_POST['nat_id_number'], $_POST['firstname'], $_POST['surname'], $_POST['nat_id_number'], $_POST['date'], $_POST['phone_number'], $_POST['email'], $_POST['med_aid']);
                  $result = mysqli_stmt_execute($stmt);

                  if ($result) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> New pharmacy customer registered, ID as <?= $userId; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> New pharmacy customer could not be registered, please use web portal!
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
                  <h4>Registered User (Customer)</h4>

                </div>

                <table id="stockTable" class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col" colspan="2">Fullname</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Email</th>
                      <th scope="col">Medical Aid</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $customers = $user->getAllUsers();
                    if ($customers !== false) {
                      foreach ($customers as $customer) {
                    ?>
                        <tr>
                          <th scope="row"><?= $customer['user_id']; ?></th>
                          <td colspan="2"><?= $customer['firstname']; ?> <?= $customer['surname']; ?></td>
                          <td><?= $customer['phone_number']; ?></td>
                          <td><?= $customer['email']; ?></td>
                          <td><?= $customer['med_aid']; ?></td>
                          <td><button id="updateCustomer" class="btn btn-sm btn-success me-2" data-user-id="<?= $customer['user_id']; ?>"><i class="fas fa-pencil"></i></button><button id="deleteCustomer" class="btn btn-sm btn-primary" data-user-id="<?= $customer['user_id']; ?>"><i class="fas fa-trash"></i></button></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <th colspan="7" class="text-center">No Registired Beneficiaries</th>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

              </section>
            </div>
            <div class="col-md-4">
              <section>
                <h4 class="mb-3">Register New User</h4>
                <form action="" id="registerUserForm" method="post">
                <div class="form-group mb-2 row">
                  <div class="col-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname" required>
                  </div>
                  <div class="col-6">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Enter Surname" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label for="nat_id_number">National ID Number</label>
                  <input type="text" name="nat_id_number" id="nat_id_number" class="form-control" placeholder="63-xxxxxx-R87" required>
                </div>
                <div class="form-group mb-2">
                  <label for="phone_number">Phone Number</label>
                  <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="071111111" required>
                </div>
                <div class="form-group mb-3">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group mb-3">
                  <label for="med_aid">Medical Aid</label>
                  <input type="text" name="med_aid" id="med_aid" class="form-control" placeholder="Enter Medical Aid Number" required>
                </div>
                <hr class="bg-primary">
                <div class="input-group my-2">
                  <!-- Hidden -->
                  <input type="hidden" name="registerUserForm" value="registerUserForm">
                  <button type="submit" class="btn btn-primary w-100">Register User</button>
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



    });
  </script>
</body>

</html>