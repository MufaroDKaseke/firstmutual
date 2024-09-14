<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./dist/lib/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./node_modules/animate.css/animate.min.css">
  <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist/css/style.min.css">
</head>
<body>

  <main>
    <section class="login bg-secondary">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6">
            <div class="login-container bg-color2 p-5 rounded-2">
              <h2>Login</h2>
              <form id="loginForm" action="test.php" method="post">
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
                      <button class="login-tab-btn btn" data-target="login-pane-3">
                        <i class="fas fa-user-doctor"></i>
                        Employee
                      </button>
                      
                    </div>

                    <div class="col-4 my-3 text-end">
                      <button class="login-tab-btn btn" data-target="login-pane-4">
                        <i class="fas fa-user"></i>
                        Patient
                      </button>
                      
                    </div>
                  </div>



                </div>
                <div class="login-pane" data-pane="login-pane-2" style="display: none;">
                  <h4>Administrator</h4>
                  <!-- Extra Input -->
                  <!--<input type="hidden" name="login" value="admin">-->
                  <!-- End Of Extra Input -->
                  <div class="input-group py-3">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="admin" id="username" class="form-control form-control-lg" placeholder="Username">
                  </div>
                  <div class="input-group py-3">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="text" name="password" id="password" class="form-control form-control-lg" placeholder="Password">
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <button class="login-tab-btn btn btn-lg btn-primary" data-target="login-pane-1">Back</button>
                    <button type="submit" name="login" value="admin" class="btn btn-lg btn-primary">Login</button> 
                  </div>
                </div>
                <div class="login-pane" data-pane="login-pane-3" style="display: none;">
                 <h4>Employee</h4>
                 <div class="input-group py-3">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input type="text" name="employee" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="input-group py-3">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="d-flex justify-content-between py-2">
                  <button class="login-tab-btn btn btn-primary" data-target="login-pane-1">Back</button>
                  <button type="submit" name="login" value="admin" class="btn btn-lg btn-primary">Login</button> 
                </div>
              </div>
              <div class="login-pane" data-pane="login-pane-4" style="display: none">
               <h4>Patient</h4>
               <!-- Extra Input -->
               <input type="hidden" name="login" value="user">
               <!-- End Of Extra Input -->
               <div class="input-group py-3">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="user" id="username" class="form-control" placeholder="Username">
              </div>
              <div class="input-group py-3">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="text" name="password" id="password" class="form-control" placeholder="Password">
              </div>
              <div class="d-flex justify-content-between py-2">
                <button class="login-tab-btn btn btn-primary" data-target="login-pane-1">Back</button>
                <button type="submit" name="login" value="admin" class="btn btn-lg btn-primary">Login</button> 

              </div>
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