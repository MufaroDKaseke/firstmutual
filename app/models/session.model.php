<?php


// Start Session
session_start(['cookie_lifetime' => 21600]);

class Session extends Database {


  function __construct() {
    parent::__construct();

    if (isset($_POST['login'])) {
      $this->login($_POST['login'], $_POST);
    } else {
      if (isset($_SESSION['user_is_logged_in'])) {
        if (!$_SESSION['user_is_logged_in']) {
          $this->errorLogin("logged_out");
        }
      } else {
        $this->errorLogin('not_logged_in');
      }
    }
  }



  function login($userType ,$data) {
    $this->connect();

    if ($userType === "admin") {
      $sql = "SELECT * FROM tbl_admins WHERE username='" . $data['username']  . "' OR email='" . $data['username'] . "';";
    } elseif ($userType === "staff") {
      $sql = "SELECT * FROM tbl_staff WHERE username='" . $data['username']  . "' OR email='" . $data['username'] . "';";
      
    } elseif ($userType === "user") {
      $sql = "SELECT * FROM tbl_users WHERE username='" . $data['username']  . "' OR email='" . $data['username'] . "';";
    } else {
      $this->close();
      $this->errorLogin("user_type_invalid");
      return false;
    }  

    $result = mysqli_query($this->db_conn, $sql);

    var_dump($data);
    if (mysqli_num_rows($result) === 1) {
      $user = mysqli_fetch_assoc($result);
      if ($user['password'] === $data['password']) {
        $this->close();
        return $this->create($userType, $user);
      } else {
        $this->close();
        $this->errorLogin("password_invalid");
        return false;
      }
    } else {
      $this->close();
      $this->errorLogin("username_invalid");
      return false;
    }
  }


  function create($userType, $userData) {
    if($userType === "admin") {
      $_SESSION['user_type'] = $userType;
      $_SESSION['admin_id'] = $userData['admin_id'];
      $_SESSION['username'] = $userData['username'];
      $_SESSION['firstname'] = $userData['firstname'];
      $_SESSION['surname'] = $userData['surname'];
      $_SESSION['email'] = $userData['email'];
    } else if ($userType === "staff") {
      $_SESSION['user_type'] = $userType;
      $_SESSION['staff_id'] = $userData['employee_id'];
      $_SESSION['username'] = $userData['username'];
      $_SESSION['firstname'] = $userData['firstname'];
      $_SESSION['surname'] = $userData['surname'];
      $_SESSION['email'] = $userData['email'];
      $_SESSION['staff_type'] = $userData['staff_type'];
      $_SESSION['phone_number'] = $userData['phone_number'];
    } else if ($userType = "user") {
      $_SESSION['user_type'] = $userType;
      $_SESSION['user_id'] = $userData['user_id'];
      $_SESSION['username'] = $userData['username'];
      $_SESSION['firstname'] = $userData['firstname'];
      $_SESSION['surname'] = $userData['surname'];
      $_SESSION['email'] = $userData['email'];
      $_SESSION['phone_number'] = $userData['phone_number'];
      $_SESSION['med_aid'] = $userData['med_aid'];
    } else {
      return false;
    }

    $_SESSION['user_is_logged_in'] = true;
    //echo 'Login Success';
    //echo "Role: " . $_SESSION['user_type'];
    //echo "Username" . $_SESSION['username'];
    return true;
  }

  function data() {
    if(isset($_SESSION)) {
      return $_SESSION;
    } else {
      return false;
    }
  }

  function logout() {
    if (isset($_SESSION)) {
      $_SESSION = array();
    }
    session_regenerate_id();
    $_SESSION['user_is_logged_in'] = false;
    return !$_SESSION['user_is_logged_in'];
  }

  function errorLogin($errorCode) {
    header("Location: " . $_ENV['ROOT'] . "dashboard/login.php?error=" . $errorCode);
    exit;
  }


}