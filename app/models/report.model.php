<?php


class Report extends Database {
  
  public function __construct() {
    parent::__construct();
  }
  
  // Get number of sales
  public function numberOfSales($date=null) {
    $this->connect();
    if ($date === null) {
      //$date = date('Y-m-d');
      $sql = "SELECT DATE(sale_date) as sale_date, COUNT(*) as total FROM tbl_sales GROUP BY DATE(sale_date)";
      $result = mysqli_query($this->db_conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $totals = [];
        while ($row = mysqli_fetch_assoc($result)) {
          $totals[$row['sale_date']] = $row;
        }
        $this->close();
        return $totals;
      } else {
        $this->close();
        return 0;
      }
    } else {
      $sql = "SELECT COUNT(*) as total FROM tbl_sales WHERE sale_date='" . $date . "';";
      $result = mysqli_query($this->db_conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return ($data['total'] === null) ? 0 : $data['total'];
      } else {
        $this->close();
        return 0;
      }
    }
  }

  // Get total daily sales(amounts)
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
        return 0;
      }
    } else {
      $sql = "SELECT SUM(total) as sum FROM tbl_sales WHERE sale_date='" . $date . "';";
      $result = mysqli_query($this->db_conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return ($data['sum'] === null) ? 0 : $data['sum'];
      } else {
        $this->close();
        return 0;
      }
    }
  }

  // Get total monthly sales
  
  // Get drug statistics
  public function numberOfStockItems() {
    $this->connect();
    $sql = "SELECT COUNT(*) as total FROM tbl_stock";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      return mysqli_fetch_assoc($result)['total'];
    } else {
      return 0;
    }
  }

  // Get Products in low stock
  public function numberOfItemsInLowStock() {
    $this->connect();
    $sql = "SELECT COUNT(*) as total FROM tbl_stock WHERE (balance - threshold) < 0";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      return mysqli_fetch_assoc($result)['total'];
    } else {
      return 0;
    }
  }

  // Get number of users
  public function totalUsers() {
    $this->connect();
    $sql = "SELECT COUNT(*) as total FROM tbl_users";
    $result = mysqli_query($this->db_conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      return mysqli_fetch_assoc($result)['total'];
    } else {
      return 0;
    }
  }

  // Customers with medical aid
  public function usersWithMedicalAid() {
    $this->connect();
    $sql = "SELECT COUNT(*) as total FROM tbl_users WHERE med_aid IS NOT NULL";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0
    ) {
      return mysqli_fetch_assoc($result)['total'];
    } else {
      return 0;
    }
  }
  
  // Get drug statistics
  public function stockByPopularity($limit=10) {
    $this->connect();
    $sql = "SELECT stock_id, SUM(quantity) as quantity FROM tbl_sales_items GROUP BY stock_id ORDER BY quantity DESC LIMIT " . $limit . ";";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $drugs = [];
      while($row = mysqli_fetch_assoc($result)) {
        $drugs[$row['stock_id']] = $row;
      }
      
      $this->close();
      return $drugs;
    } else {
      $this->close();
      return 0;
    }
  }
}