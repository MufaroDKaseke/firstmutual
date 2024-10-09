<?php


class Staff extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "staff") {
      header("Location: " . $_ENV['ROOT']  . "dashboard/login.php");
    }
    parent::__construct();
  }

  public function updateInformation($formData) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_staff SET email=?, phone_number=? WHERE staff_id=?;");
    mysqli_stmt_bind_param($stmt, 'sis', $formData['email'], $formData['phone_number'], $formData['staff_id']);
    $result = mysqli_stmt_execute($stmt);

    $this->close();
    return $result;
  }

  public function resetPassword($formData) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_staff SET `password`=? WHERE staff_id=?;");
    mysqli_stmt_bind_param($stmt, 'ss', $formData['password'], $formData['staff_id']);
    $result = mysqli_stmt_execute($stmt);

    $this->close();
    return $result;
  }

}