<?php


class Admin extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "admin") {
      header("Location: " . $_ENV['ROOT']);
    }
    parent::__construct();
  }
}