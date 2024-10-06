<?php


class Admin extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "admin") {
      header("Location: " . $_ENV['ROOT']  . "dashboard/login.php");
    }
    parent::__construct();
  }

  public function getAllUsers() {
    $this->connect();
    $sql = "SELECT * FROM tbl_users;";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      $users = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $users[$row['user_id']] = $row;
      }
      return $users;
    } else {
      return false;
    }
  }

  public function getAllStaff() {
    $this->connect();
    $sql = "SELECT * FROM tbl_staff;";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      $users = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $users[$row['staff_id']] = $row;
      }
      return $users;
    } else {
      return false;
    }
  }

  // Delete User
  public function deleteUser($userId) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "DELETE FROM tbl_users WHERE user_id=?;");
    mysqli_stmt_bind_param($stmt, 's', $userId);
    $result = mysqli_stmt_execute($stmt);

    $this->close();
    return $result;
  }
  
  // Update User

  // Update password
  public function resetPassword($data) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_admins SET password=? WHERE admin_id=?;");
    mysqli_stmt_bind_param($stmt, 'ss', $data['password'], $data['admin_id']);
    $result = mysqli_stmt_execute($stmt);

    $this->close();
    return $result;
  }
  
}