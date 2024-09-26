<?php
require './vendor/autoload.php';
require './app/config/config.php';
require './app/models/db.model.php';

$db = new Database();

function generateUserId()
{
  $a = '';
  for ($i = 0; $i < 6; $i++) {
    $a .= mt_rand(0, 9);
  }

  return 'usr_' . $a;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Firstmutual | Registration</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>dist/css/style.min.css">
</head>

<body class="bg-primary">


  <section>
    <div class="container">
      <div class="row align-items-center justify-content-center min-vh-100">
        <div class="col-md-6">
          <div class="bg-white rounded-5 p-4 text-center">
            <?php

            if (isset($_POST['register'])) {
              $db->connect();

              do {
                $userId = generateUserId();
                $sql = "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'";
                $result = mysqli_query($db->db_conn, $sql);
              } while (mysqli_num_rows($result) > 0);

              $stmt = mysqli_prepare($db->db_conn, "INSERT INTO tbl_users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
              mysqli_stmt_bind_param($stmt, 'ssssssssss', $userId, $_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['surname'], $_POST['nat_id_number'], $_POST['date_of_birth'], $_POST['phone_number'], $_POST['email'], $_POST['med_id']);
              $result = mysqli_stmt_execute($stmt);

              if ($result) {
                $stmt = mysqli_prepare($db->db_conn, "INSERT INTO tbl_medical_aid VALUES (?, ?, ?, ?);");
                mysqli_stmt_bind_param($stmt, 'ssss', $_POST['med_id'], $_POST['employer'], $_POST['issue_date'], $_POST['expiry_date']);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
            ?>
                  <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" class="img-fluid w-50 mb-3">
                  <br>
                  <i class="fa fa-circle-check fa-4x text-success mb-2"></i>
                  <h3>Registration successful</h3>
                  <a href="<?= $_ENV['ROOT']; ?>dashboard/login.php" class="btn btn-primary">Login</a>
                <?php
                  $db->close();
                } else {
                ?>
                  <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" class="img-fluid w-50 mb-3">
                  <br>
                  <i class="fa fa-circle-check fa-4x text-success mb-2"></i>
                  <h3>Registration successful. You can update medical aid later!</h3>
                  <a href="#" class="btn btn-primary">Login</a>
                <?php
                }
              } else {
                ?>
                <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" class="img-fluid w-50 mb-3">
                <br>
                <i class="fa fa-circle-xmark fa-4x text-primary mb-2"></i>
                <h3>Registration Error</h3>
                <a href="<?= $_ENV['ROOT']; ?>registration.php" class="btn btn-primary">Register</a>
            <?php
                $db->close();
              }
            }

            ?>

          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="<?= $_ENV['ROOT']; ?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>dist/js/main.js"></script>
</body>

</html>