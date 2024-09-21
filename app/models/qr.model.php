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

    if(mysqli_num_rows($result) === 1) {
      $data =  mysqli_fetch_assoc($result);
      $this->close();
      return $data;
    } else {
      return false;
    }
  }

  // Get user medical aid
  public function getUserMedicalAid($qrCode) {
    $this->connect();
    $sql = "SELECT * FROM tbl_medical_aid WHERE user_id='" . $qrCode . "'";

    $result = mysqli_query($this->db_conn, $sql);

    if(mysqli_num_rows($result) === 1) {
      $data =  mysqli_fetch_assoc($result);
      $this->close();
      return $data;
    } else {
      return false;
    }
  }
}