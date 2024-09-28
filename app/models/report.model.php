<?php


class Report extends Database {
  
  public function __construct() {
    parent::__construct();
  }
  
  // Get total daily sales
  public function dailySales($date=null) {
    $this->connect();
    if ($date === null) {
      //$date = date('Y-m-d');
      $sql = "SELECT DATE(sale_date) as sale_date, SUM(total) as sum FROM tbl_sales GROUP BY DATE(sale_date)";
      $result = mysqli_query($this->db_conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $totals = [];
        while($row = mysqli_fetch_assoc($result)) {
          $totals[$row['sale_date']] = $row;
        }
        $this->close();
        return $totals;
      } else {
        $this->close();
        return false;
      }
    } else {
      $sql = "SELECT SUM(total) as sum FROM tbl_sales WHERE sale_date='" . $date . "';";
      $result = mysqli_query($this->db_conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['sum'];
      } else {
        $this->close();
        return false;
      }
    }
  }
  
  // Get total monthly sales
  
  // Get drug statistics
  // Get number of users
  // Get popular meds
}