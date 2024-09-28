<?php

// Class for all stock management
class Stock extends Database {

  public function __construct() {
    parent::__construct();
  }

  // Add New Drug
  public function addDrug($data) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "INSERT INTO tbl_stock VALUES(?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, 'sssddd', $data['id'], $data['name'], $data['description'], $data['threshold'], $data['price'], $data['balance']);

    $result = mysqli_stmt_execute($stmt);
    $this->close();
    return $result;
  }

  // Add New Stock
  public function addStock($drugId, $data) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_stock SET balance=balance+? WHERE stock_id=?;");
    mysqli_stmt_bind_param($stmt, 'is', $data['amount'], $drugId);

    if(mysqli_stmt_execute($stmt)) {
      $stmt = mysqli_prepare($this->db_conn, "INSERT INTO tbl_stock_entries VALUES(?, ?, CURRENT_TIMESTAMP, ?);");
      mysqli_stmt_bind_param($stmt, 'ssd', $drugId, $data['supplier'], $data['amount']);

      $result = mysqli_stmt_execute($stmt);
      $this->close();
      return $result;
    } else {
      $this->close();
      return false;
    }
  }

  // Get drug info
  public function getDrug() {
    $this->connect();
    $sql = "SELECT * FROM tbl_stock WHERE stock_id='" . $drugId . "';";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      $drug = mysqli_fetch_assoc($result);
      $this->close();
      return $drug;
    } else {
      $this->close();
      return false;
    }
  }
  

  // Change Threshold
  public function setThreshold($drugId, $newThreshold) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_stock SET threshold=? WHERE stock_id=?;");
    mysqli_stmt_bind_param($stmt, 'is', $newThreshold, $drugId);
    $result = mysqli_stmt_execute($stmt);

    $this->close();
    return $result;
  }

  // Check For Stock Below Threshold
  public function drugsBelowThreshold() {
    $this->connect();
    $sql = "SELECT * FROM tbl_stock WHERE (balance - threshold < 0);";
    $result = mysqli_query($this->db_conn, $sql);

    if(mysqli_num_rows($result) > 0) {

      $drugs = [];
      while($row = mysqli_fetch_assoc($result)) {
        $drugs[$row['stock_id']] = $row;
      }
      return $drugs;
    } else {
      return false;
    }
  }

  // Check if specific drug is out of stock
  public function drugIsBelowThreshold($drugId) {
    $this->connect();
    $sql = "SELECT * FROM tbl_stock WHERE stock_id='" . $drugId . "';";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      $drug = mysqli_fetch_assoc($result);
      $this->close();

      if($drug['balance'] - $drug['threshold'] > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      $this->close();
      return false;
    }

  }

  // Check if drug is completely out of stock
  public function drugIsAvailable($drugId) {
    $this->connect();
    $sql = "SELECT * FROM tbl_stock WHERE stock_id='" . $drugId . "';";
    $result = mysqli_query($this->db_conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      $drug = mysqli_fetch_assoc($result);
      $this->close();
      if($drug['balance'] > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      $this->close();
      return false;
    }
  }


  // Get all drugs that are available
  public function availableDrugs() {
    $this->connect();
    $sql = "SELECT * FROM tbl_stock WHERE (balance >= 1);";
    $result = mysqli_query($this->db_conn, $sql);
  
    if (mysqli_num_rows($result) > 0) {
  
      $drugs = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $drugs[$row['stock_id']] = $row;
      }
      return $drugs;
    } else {
      return false;
    }
  }
}
