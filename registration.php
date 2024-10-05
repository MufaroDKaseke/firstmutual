<?php

require_once './vendor/autoload.php';
require_once './app/config/config.php';
require_once './app/models/db.model.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>First Mutual Pharmacy | Registration</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist/css/style.min.css">
</head>

<body class="bg-primary">



  <main>
    <section class="register">
      <div class="container">
        <div class="row align-items-center justify-content-center min-vh-100">
          <div class="col-lg-6">
            <div class="register-form p-5 bg-white border-3 rounded-4">
              <div class="text-center mb-3">
                <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="Firstmutual Logo" class="img-fluid w-50">
              </div>
              <h4 class="text-center mb-4">Registration Form</h4>
              <ul class="register-progressbar px-0">
                <li class="active"><strong>Personal Details</strong></li>
                <li><strong>Medical Aid</strong></li>
                <li><strong>Account</strong></li>
              </ul>
              <form action="registration-complete.php" method="post">
                <fieldset class="show">
                  <div class="row mb-3">
                    <div class="col-md-6 mt-4">
                      <label for="firstname" class="form-label">Firstname <sup class="text-primary">*</sup></label>
                      <div class="form-group">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" required>
                      </div>
                    </div>
                    <div class="col-md-6 mt-4">
                      <label for="surname" class="form-label">Surname <sup class="text-primary">*</sup></label>
                      <div class="form-group ">
                        <input type="text" name="surname" id="surname" class="form-control" placeholder="Lastname" required>
                      </div>
                    </div>
                  </div>

                  <label for="nat_id_number" class="form-label mt-3">National ID Number <sup class="text-primary">*</sup></label>
                  <div class="form-group">
                    <input type="text" name="nat_id_number" id="nat_id_number" class="form-control" placeholder="63-xxxxxxxx-R72">
                  </div>

                  <div class="row">
                    <!--Date of birth-->
                    <div class="col-md-6 mt-4">
                      <label for="date_of_birth" class="form-label">Date of Birth <sup class="text-primary">*</sup></label>
                      <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                    </div>
                    <!--sex-->
                    <div class="col-md-6 mt-4">
                      <label for="gender" class="form-label">Sex</label>
                      <div class="form-group">
                        <div class="form-check me-3">
                          <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked>
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
                  <label for="email" class="form-label mt-3">Email <sup class="text-primary">*</sup></label>
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                  </div>
                  <!--phone number-->
                  <label for="phone_number" class="form-label mt-3">Phone Number <sup class="text-primary">*</sup></label>
                  <div class="form-group">
                    <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" required>
                  </div>



                  <!--complete submission button-->
                  <div class="input-group my-3 justify-content-end">
                    <button type="button" class="register-next btn btn-primary">Next</button>
                  </div>
                </fieldset>

                <fieldset>
                  <label for="med_id">Medical Aid Number</label>
                  <div class="form-group my-2">
                    <input type="text" name="med_id" id="med_id" class="form-control" placeholder="Medical Aid Number">
                  </div>
                  <label for="issuer">Issuer</label>
                  <div class="form-group my-2">
                    <select name="issuer" id="issuer" class="form-select">
                      <option value="">First Mutual</option>
                      <option value="">NEC</option>
                      <option value="">Provider</option>
                      <option value="">Provider</option>
                      <option value="">Provider</option>
                      <option value="">Provider</option>
                    </select>
                  </div>
                  <label for="employer">Employer</label>
                  <div class="form-group my-2">
                    <input type="text" name="employer" id="employer" class="form-control" placeholder="Employer">
                  </div>
                  <label for="issue_date">Issue Date</label>
                  <div class="form-group my-2">
                    <input type="date" name="issue_date" id="issue_date" class="form-control" placeholder="Issue Date">
                  </div>
                  <label for="expiry_date">Expiry Date</label>
                  <div class="form-group my-2">
                    <input type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="Expiry Date">
                  </div>
                  <!--complete submission button-->
                  <div class="input-group my-3 justify-content-end">
                    <button type="button" class="register-next btn btn-primary">Next</button>
                  </div>
                </fieldset>

                <fieldset>
                  <label for="username">Username <sup class="text-primary">*</sup></label>
                  <div class="form-group my-2">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                  </div>
                  <label for="password">Password <sup class="text-primary">*</sup></label>
                  <div class="form-group my-2">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                  </div>
                  <label for="confirm_password">Confirm Password <sup class="text-primary">*</sup></label>
                  <div class="form-group my-2">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Password again" required>
                  </div>
                  <!--complete submission button-->
                  <div class="input-group my-3 justify-content-end">
                    <button type="submit" name="register" value="user" class="btn btn-primary">Complete Registration</button>
                  </div>
                </fieldset>

              </form>

            </div>

          </div>
        </div>
      </div>
    </section>
  </main>


  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="./dist/js/main.js"></script>
  <script>
    $(document).ready(function() {

      // Get next fieldset on registration form
      $('.register-next').on('click', (e) => {
        $('.register-form form').validate({
          rules: {
            confirm_password: {
              equalTo: "#password"
            }
          },
          messages: {
            confirm_password: {
              equalTo: "The passwords must match."
            }
          }
        });

        // Check if fieldset fields are valid
        if ($('.register-form form fieldset.show input').valid()) {
          let next_fs = $('.register-form form fieldset.show ~ fieldset:first');
          let current_fs = $('.register-form form fieldset.show').removeClass('show');

          next_fs.addClass('show');
          $('.register .register-progressbar li.active:last ~ li:first').addClass('active');
        }
      });
    });
  </script>
</body>

</html>