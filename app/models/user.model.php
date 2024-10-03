<?php


class User extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "user") {
      header("Location: " . $_ENV['ROOT']  . "dashboard/login.php");
    }
    parent::__construct();
  }


  // Get user details
  public function getUserDetails($userId) {
    $this->connect();
    $sql = "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'";

    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      $data =  mysqli_fetch_assoc($result);
      $this->close();
      return $data;
    } else {
      return false;
    }
  }

  // Get user prescriptions
  public function getUserPrescriptions($userId) {
    $this->connect();
    $sql = "SELECT * FROM tbl_prescriptions WHERE user_id='" . $userId . "'";

    $result = mysqli_query($this->db_conn, $sql);

    $presc = [];
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $presc[$row['presc_id']] = $row;
      }
      $this->close();
      return $presc;
    } else {
      return false;
    }
  }

  // Get user medical aid
  public function getUserMedicalAid($userId) {
    $user = $this->getUserDetails($userId);
    if ($user !== false) {
      $this->connect();
      $sql = "SELECT * FROM tbl_medical_aid WHERE med_id='" . $user['med_aid'] . "'";
      $result = mysqli_query($this->db_conn, $sql);

      if (mysqli_num_rows($result) === 1) {
        $data =  mysqli_fetch_assoc($result);
        $this->close();
        return $data;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}