<?php


class Staff extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "staff") {
      header("Location: " . $_ENV['ROOT']);
    }
    parent::__construct();
  }
}