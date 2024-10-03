<?php

require_once '../vendor/autoload.php';
require_once '../app/config/config.php';

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
    <section class="login bg-primary">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6">
            <div class="login-container bg-color2 p-5 rounded-2">
              <div class="text-center">
                <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" width="60%" class="img-fluid">
              </div>
              <h2 class="text-center mb-3">Login</h2>
              <form id="loginForm" action="<?= $_ENV['ROOT']; ?>dashboard/authenticate.php" method="post">
                <div class="login-pane show active" data-pane="login-pane-1">
                  <h4>Choose Account Type</h4>

                  <div class="row justify-content-between">
                    <div class="col-4 my-3 text-start">
                      <button class="login-tab-btn btn" data-target="admin">
                        <i class="fas fa-user-gear"></i>
                        Admin
                      </button>

                    </div>
                    <div class="col-4 my-3 text-center">
                      <button class="login-tab-btn btn" data-target="staff">
                        <i class="fas fa-user-doctor"></i>
                        Employee
                      </button>

                    </div>

                    <div class="col-4 my-3 text-end">
                      <button class="login-tab-btn btn" data-target="user">
                        <i class="fas fa-user"></i>
                        Patient
                      </button>

                    </div>
                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


  <script src="<?= $_ENV['ROOT']; ?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_ENV['ROOT']; ?>dist/js/main.js"></script>
  <script>
    $(document).ready(function() {

      const loginTabBtn = $('.login-tab-btn');

      // Get login form tab
      loginTabBtn.on('click', function(e) {
        e.preventDefault();
        
        // Get specific form
        $.ajax({
          url: `<?=$_ENV['ROOT'];?>app/services/login-form-${$(this).attr('data-target')}.php`,
          type: 'GET',
          dataType: 'html',
          success: function(htmlData) {
            $('#loginForm').html(htmlData);
          }

        });
        
      });


    });
  </script>
</body>

</html>