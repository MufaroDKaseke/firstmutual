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

  // Delete User
  // Update User
  
}