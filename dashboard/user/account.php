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
            <div class="col-6">
              <section>
                <?php
                $userInfo = $user->getUserDetails($_SESSION['user_id']);
                $medicalAidInfo = $user->getUserMedicalAid($_SESSION['user_id']);

                ?>

                <h3>Medical Aid Infomation</h3>
                <ul class="nav nav-tabs" id="userInfoTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info-tab-pane" type="button" role="tab" aria-controls="personal-info-tab-pane" aria-selected="true">Personal Information</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="medical-aid-tab" data-bs-toggle="tab" data-bs-target="#medical-aid-tab-pane" type="button" role="tab" aria-controls="medical-aid-tab-pane" aria-selected="false">Medical Aid</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane" type="button" role="tab" aria-controls="account-tab-pane" aria-selected="false">Account</button>
                  </li>
                </ul>
                <div class="tab-content" id="userInfoTabsContent">
                  <div class="tab-pane fade show active" id="personal-info-tab-pane" role="tabpanel" aria-labelledby="personal-info-tab" tabindex="0">
                    <form id="personalInfoForm" action="">
                      <fieldset>
                        <div class="row mb-3">
                          <div class="col-md-6 mt-4">
                            <label for="firstname" class="form-label">Firstname</label>
                            <div class="input-group">
                              <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" value="<?= $userInfo['firstname']; ?>">
                            </div>
                          </div>
                          <div class="col-md-6 mt-4">
                            <label for="surname" class="form-label">Surname</label>
                            <div class="input-group ">
                              <input type="text" name="surname" id="surname" class="form-control" placeholder="Lastname" value="<?= $userInfo['surname']; ?>">
                            </div>
                          </div>
                        </div>

                        <label for="nat_id_number" class="form-label mt-3">National ID Number</label>
                        <div class="input-group">
                          <input type="text" name="nat_id_number" id="nat_id_number" class="form-control" placeholder="63-xxxxxxxx-R72" value="<?= $userInfo['nat_id_number']; ?>">
                        </div>

                        <div class="row">
                          <!--Date of birth-->
                          <div class="col-md-6 mt-4">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= $userInfo['dob']; ?>">
                          </div>
                          <!--sex-->
                          <div class="col-md-6 mt-4">
                            <label for="gender" class="form-label">Sex</label>
                            <div class="input-group">
                              <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="male">
                                <label class="form-check-label" for="gender1">
                                  Male
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
                                <label class="form-check-label" for="gender2">
                                  Female
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!--email-->
                        <label for="email" class="form-label mt-3">Email</label>
                        <div class="input-group">
                          <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= $userInfo['email']; ?>">
                        </div>
                        <!--phone number-->
                        <label for="phone_number" class="form-label mt-3">Phone Number</label>
                        <div class="input-group">
                          <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" value="<?= $userInfo['phone_number']; ?>">
                        </div>



                        <!--complete submission button-->
                        <div class="input-group my-3 justify-content-end">
                          <button type="button" class="register-next btn btn-primary">Update Detaiils</button>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="medical-aid-tab-pane" role="tabpanel" aria-labelledby="medical-aid-tab" tabindex="0">
                    <?php
                    if ($medicalAidInfo === false) {
                      $medicalAidInfo = ['med_id' => '', 'employer' => '', 'issue_date' => '', 'expiry_date' => ''];
                    ?>
                      <div class="alert alert-warning my-2 py-2" role="alert"><i class="fa fa-circle-xmark me-2"></i>You don't have any medical aid info registered!</div>
                    <?php
                    }
                    ?>
                    <form id="medicalAidForm" action="">
                      <fieldset>
                        <label for="med_id">Medical Aid Number</label>
                        <div class="input-group my-2">
                          <input type="text" name="med_id" id="med_id" class="form-control" placeholder="Medical Aid Number" value="<?= $medicalAidInfo['med_id']; ?>">
                        </div>
                        <label for="issuer">Issuer</label>
                        <div class="input-group my-2">
                          <select name="issuer" id="issuer" class="form-select">
                            <option value="First Mutual">First Mutual</option>
                          </select>
                        </div>
                        <label for="employer">Employer</label>
                        <div class="input-group my-2">
                          <input type="text" name="employer" id="employer" class="form-control" placeholder="Employer" value="<?= $medicalAidInfo['employer']; ?>">
                        </div>
                        <label for="issue_date">Issue Date</label>
                        <div class="input-group my-2">
                          <input type="date" name="issue_date" id="issue_date" class="form-control" placeholder="Issue Date" value="<?= $medicalAidInfo['issue_date']; ?>">
                        </div>
                        <label for="expiry_date">Expiry Date</label>
                        <div class="input-group my-2">
                          <input type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="Expiry Date" value="<?= $medicalAidInfo['expiry_date']; ?>">
                        </div>
                        <!--complete submission button-->
                        <div class="input-group my-3 justify-content-end">
                          <button type="submit" class="btn btn-primary">Update Medical Info</button>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab" tabindex="0">
                    <form action="" id="accountForm">
                      <fieldset>
                        <label for="username">User Id</label>
                        <div class="input-group my-2">
                          <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Enter Username" value="<?= $userInfo['user_id']; ?>" disabled>
                        </div>
                        <label for="username">Username</label>
                        <div class="input-group my-2">
                          <input type="text" name="username" id="username" class="form-control" value="<?= $userInfo['username']; ?>" disabled>
                        </div>
                        <label for="password">Password</label>
                        <div class="input-group my-2">
                          <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <label for="confirm-password">Password</label>
                        <div class="input-group my-2">
                          <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Enter Password again" required>
                        </div>
                        <!--complete submission button-->
                        <div class="input-group my-3 justify-content-end">
                          <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
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