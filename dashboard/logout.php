<?php

require_once '../vendor/autoload.php';

require_once '../app/config/config.php';
require_once '../app/models/db.model.php';
require_once '../app/models/session.model.php';

$session = new Session();




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_ENV['ROOT']; ?>dist/css/style.min.css">
</head>

<body>

  <main>
    <section class="logout bg-primary">
      <div class="container">
        <div class="row align-items-center justify-content-center min-vh-100">
          <div class="col-md-6">
            <div class="bg-white rounded-5 p-4 text-center">
              <?php
              if ($session->logout()) {
              ?>
                <i class="fa fa-circle-check fa-4x text-danger mb-2"></i>
                <h3>Logged out!</h3>
                <a href="<?= $_ENV['ROOT']; ?>dashboard/login.php" class="btn btn-primary">Login Again</a>
              <?php
              } else {
              ?>
                <i class="fa fa-exclamation-triangle fa-4x text-danger mb-2"></i>
                <h3>Still logged in!</h3>
                <a href="<?= $_ENV['ROOT']; ?>" class="btn btn-primary">Home Page</a>
              <?php
              }

              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


  <script src="<?= $_ENV['ROOT']; ?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>dist/js/main.js"></script>
</body>

</html>