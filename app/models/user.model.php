<?php


class User extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "user") {
      header("Location: " . $_ENV['ROOT']  . "dashboard/login.php");
    }
    parent::__construct();
  }
}