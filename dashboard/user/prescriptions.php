<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/user.model.php';
require_once '../../app/models/prescription.model.php';

$session = new Session();
$user = new User();
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
            <div class="col-12">
              <div class="dashboard-alerts">
                <!-- Alerts go here -->
                <?php
                if (isset($_POST['upload_prescription_user'])) {
                  $_POST['user_id'] = $_SESSION['user_id'];
                  if ($prescription->uploadPrescription($_POST, $_FILES['presc_img'])) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> New prescription successfully uploaded!</b>.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> Error occured whilst uploading prescription, please try again</b>.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
            <div class="col-lg-9">
              <section>
                <div class="d-flex justify-content-between mb-3">
                  <h4>My Prescriptions</h4>

                  <form id="stockPrescriptionsForm" action="">
                    <div class="input-group">
                      <input type="text" name="q" id="q" class="form-control form-control-sm" placeholder="Search Prescriptions">
                      <div class="input-group-text p-0">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

                <table id="stockTable" class="table">
                  <thead>
                    <tr>
                      <th scope="col">Uploaded On</th>
                      <th scope="col" colspan="3">Image</th>
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
                    $prescriptions = $prescription->getUserPrescriptions($_SESSION['user_id']);
                    if ($prescriptions !== false) {
                      foreach ($prescriptions as $item) {
                    ?>
                        <tr>
                          <th scope="row"><?= $item['uploaded_on']; ?></th>
                          <td colspan="3"><img src="data:image/png;base64,<?= $item['img']; ?>" alt="<?= $item['user_id']; ?>" width="300px" class="img-fluid"></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="6" class="text-center">No Prescriptions Available</td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

              </section>
            </div>
            <div class="col-lg-3">
              <section>
                <h4 class="mb-3">Upload Prescription</h4>
                <form action="" method="post" enctype="multipart/form-data">
                  <label for="user_id">Patients ID</label>
                  <div class="input-group mb-3">
                    <input type="text" name="user_id" id="user_id" placeholder="User ID" class="form-control" value="<?=$_SESSION['user_id'];?>" disabled>
                  </div>
                  <label for="presc_img">Picture Of Prescription</label>
                  <div class="input-group">
                    <input type="file" name="presc_img" id="presc_img" class="form-control">
                  </div>
                  <hr class="my-3">
                  <div class="input-group my-2 justify-content-end">
                    <!-- Hidden -->
                    <input type="hidden" name="upload_prescription_user" value="upload_presciption_staff">
                    <button type="submit" class="btn btn-primary">Upload</button>
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
    $(document).ready(function() {});
  </script>
</body>

</html>