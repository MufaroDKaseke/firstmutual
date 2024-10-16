<?php


class QR extends Database {

  function __construct() {
    parent::__construct();
  }

  // Get user details
  public function getUserDetails($qrCode) {
    $this->connect();
    $sql = "SELECT * FROM tbl_users WHERE user_id='" . $qrCode . "'";

    $result = mysqli_query($this->db_conn, $sql);

    if(mysqli_num_rows($result) === 1) {
      $data =  mysqli_fetch_assoc($result);
      $this->close();
      return $data;
    } else {
      return false;
    }
  }

  // Get user prescriptions
  public function getUserPrescriptions($qrCode) {
    $this->connect();
    $sql = "SELECT * FROM tbl_prescriptions WHERE user_id='" . $qrCode . "'";

    $result = mysqli_query($this->db_conn, $sql);

    $presc = [];
    if(mysqli_num_rows($result) > 0) {
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
  public function getUserMedicalAid($qrCode) {
    $user = $this->getUserDetails($qrCode);
    if ($user !== false) {
      $this->connect();
      $sql = "SELECT * FROM tbl_medical_aid WHERE med_id='" . $user['med_aid'] . "'";
      $result = mysqli_query($this->db_conn, $sql);
  
      if(mysqli_num_rows($result) === 1) {
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