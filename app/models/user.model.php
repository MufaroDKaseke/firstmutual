<?php


class User extends Database {

  public function __construct() {
    if ($_SESSION['user_type'] !== "user") {
      header("Location: " . $_ENV['ROOT']);
    }
    parent::__construct();
  }
}