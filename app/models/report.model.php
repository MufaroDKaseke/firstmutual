<?php


class Report extends Database {

  public function __construct() {
    parent::__construct();
  }

  // Get total daily sales
  public function dailySales($date=null) {
    $this->connect();
    if ($date === null) {
      $date = date('Y-m-d');
    }

    $sql = "SELECT SUM(total) as sum FROM tbl_sales";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      return mysqli_fetch_assoc($result)['sum'];
    } else {
      return false;
    }
  }
  
  // Get total monthly sales
  // Get drug statistics
  // Get number of users
  // Get popular meds
}