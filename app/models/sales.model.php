<?php

class Sales extends Database {

  public function __construct() {
    parent::__construct();
  }

  // Generate Sale id
  private function generateId() {
    $a = '';
    for ($i = 0; $i < 8; $i++) {
      $a .= mt_rand(0, 9);
    }

    return 'sal_' . $a;
  }

  // New Sale
  public function newEntry($data) {

    $entryId = $this->generateId();
    $this->connect();
    
    $total = 0;
    foreach ($data['items'] as $item) {
      $stmt = mysqli_prepare($this->db_conn, "INSERT INTO tbl_sales_items VALUES (?, ?, ?, ?);");
      mysqli_stmt_bind_param($stmt, 'ssid', $entryId, $item->stock_id, $item->quantity, $item->subtotal);
      $result = mysqli_stmt_execute($stmt);

      if(!$result) {
        die('Error adding sale items!!!');
      } else {
        //mysqli_stmt_execute(mysqli_stmt_bind_param(mysqli_prepare($this->db_conn, "UPDATE tbl_stock SET balance=(balance - ?) WHERE stock_id=?;"), 'is', $item->quantity, $item->stock_id));
        $total += $item->subtotal;
      }
    }

    $stmt = mysqli_prepare($this->db_conn, "INSERT INTO tbl_sales VALUES (?, CURRENT_TIMESTAMP, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, 'ssssds', $entryId, $data['user_id'], $data['presc_id'], $_SESSION['staff_id'], $total, $_POST['payment_method']);
    $result = mysqli_stmt_execute($stmt);

    $this->close();
    return $result;
  }

  // Do payment on sale
}