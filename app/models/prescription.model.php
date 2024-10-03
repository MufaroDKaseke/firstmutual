<?php


class Prescription extends Database {

  public function __construct() {
    parent::__construct();

  }

  // Upload patient's prescription
  public function uploadPrescription($data, $file) {

    if ($file['error'] === UPLOAD_ERR_OK) {
      $base64Image = base64_encode(file_get_contents($file['tmp_name']));

      $prescriptionId = generateId('prsc_');
      $this->connect();
      $stmt = mysqli_prepare($this->db_conn, "INSERT INTO tbl_prescriptions VALUES(?, ?, ?, CURRENT_TIMESTAMP);");
      mysqli_stmt_bind_param($stmt, 'sss', $prescriptionId, $data['user_id'], $base64Image);

      $result = mysqli_stmt_execute($stmt);
      $this->close();
      return $result;
    } else {
      return false;
    }
  }

  // Get all prescriptions
  public function getAllPrescriptions() {
    $this->connect();
    $sql = "SELECT * FROM tbl_prescriptions ORDER BY uploaded_on DESC";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $prescriptions = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $prescriptions[$row['presc_id']] = $row;
      }
      $this->close();
      return $prescriptions;
    } else {
      $this->close();
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
}
