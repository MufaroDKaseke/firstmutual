<?php


class Staff extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "staff") {
      header("Location: " . $_ENV['ROOT']  . "dashboard/login.php");
    }
    parent::__construct();

    // More session variables
    $_SESSION['queue'] = 0;
  }

}