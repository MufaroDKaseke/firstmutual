<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Firstmutual | Registration</title>
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
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="register-form p-3 bg-white border-3">
              <h4 class="text-center mb-2">User Registration Form</h4>
              <form action="#">

                <!--Question-->

                <div class="form-check-buttons my-3">
                  <p>Taking any medications, currently?</p>

                  <div class="form-check">
                    <input type="radio" class="form-check-input" type="radio" name="flexRadioDefault1" id="yes">
                    <label for="yes" class="form-check-label">Yes</label>
                  </div>

                  <div class="form-check">
                    <input type="radio" class="form-check-input" type="radio" name="flexRadioDefault2" id="no">
                    <label for="no" class="form-check-label">No</label>

                  </div>
                </div>

                <!--Emergency contact-->
                <section class="emergency">
                  <div class="container justify-content-center">
                    <div class="row">
                      <div class="emergency-heading mb-3">
                        <h4 class="text-center">In case of emergency</h4>
                      </div>
                      <div class="row">
                        <!--Emergency contact name-->
                        <div class="col-lg-6">
                          <label for="emergency-contact" class="form-label">FirstName</label>
                          <div class="input-group">
                            <input type="text" name="emergency-contact" id="emergency-contact" class="form-control" placeholder="Next of kin name">
                          </div>
                          <div class="form-text mb-3" id="basic-addon">Emergency Contact Name</div>
                        </div>
                        <!--Emergency contact lastname-->
                        <div class="col-lg-6">
                          <label for="emergency-contact" class="form-label">LastName</label>
                          <div class="input-group">
                            <input type="text" name="emergency-contact" id="emergency-contact" class="form-control" placeholder="Next of kin last name">
                          </div>
                          <div class="form-text mb-3" id="basic-addon">Emergency Contact Last Name</div>
                        </div>
                      </div>
                      <div class="row">
                        <!--Emergency contact phone number-->
                        <div class="col">
                          <label for="emergency-phone" class="form-label">Phone Number</label>
                          <div class="input-group">
                            <input type="tel" name="emergency-phone" id="emergency-phone" class="form-control" placeholder="Next of kin phone number">
                          </div>
                          <div class="form-text" id="basic-addon1">Emergency Contact Number</div>

                          <!--Emergency contact relationship-->
                          <div class="col mt-3">
                            <label for="emergency-relationship" class="form-label">Relationship</label>
                            <div class="input-group">
                              <input type="text" name="emergency-relationship" id="emergency-relationship" class="form-control" placeholder="Relationship with next of kin">
                            </div>
                            <div class="form-text" id="basic-addon1">Relationship</div>
                          </div>
                        </div>
                      </div>
                    </div>
                </section>
                <!--complete submission button-->
                <div class="input-group my-3 justify-content-end">
                  <button type="submit" class="btn btn-primary">Complete Registration</button>
                </div>


              </form>

            </div>

          </div>
        </div>
      </div>
    </section>
  </main>


  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./dist/js/main.js"></script>
</body>

</html>