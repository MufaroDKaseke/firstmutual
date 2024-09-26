<?php

require '../../vendor/autoload.php';
require '../config/config.php';
require '../models/db.model.php';

$db = new Database();

function generateUserId()
{
  for ($i = 0; $i < 6; $i++) {
    $a .= mt_rand(0, 9);
  }

  return 'usr_' . $a;
}


if (isset($_POST['register'])) {
  $db->connect();

  do {
    $userId = generateUserId();
    $sql = "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'";
  } while (mysqli_num_rows($result) > 0);


  $stmt = mysqli_prepare($db->db_conn, "INSERT INTO tbl_users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?");
  mysqli_stmt_bind_param($stmt, 'ssssssssss', $userId, $_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['surname'], $_POST['nat_id_number'], $_POST['dob'], $_POST['email'], $_POST['med_aid']);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    $stmt = mysqli_prepare($db->db_conn, "INSERT INTO tbl_medical_aid VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $_POST['med_id'], $_POST['employer'], $_POST['issue_date'], $_POST['expiry_date']);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
?>
      <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" class="img-fluid w-50 mb-3">
      <br>
      <i class="fa fa-circle-check fa-4x text-success mb-2"></i>
      <h3>Registration successful</h3>
      <a href="<?= $_ENV['ROOT']; ?>dashboard/login.php" class="btn btn-primary">Login</a>
    <?php
      $db->close();
    } else {
    ?>
      <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" class="img-fluid w-50 mb-3">
      <br>
      <i class="fa fa-circle-check fa-4x text-success mb-2"></i>
      <h3>Registration successful. You can update medical aid later!</h3>
      <a href="#" class="btn btn-primary">Login</a>
    <?php
    }
  } else {
    ?>
    <img src="<?= $_ENV['ROOT']; ?>dist/img/first-mutual-logo.svg" alt="" class="img-fluid w-50 mb-3">
    <br>
    <i class="fa fa-circle-xmark fa-4x text-primary mb-2"></i>
    <h3>Registration Error</h3>
    <a href="<?= $_ENV['ROOT']; ?>registration.php" class="btn btn-primary">Register</a>
<?php
    $db->close();
  }
}
