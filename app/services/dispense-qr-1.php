<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/staff.model.php';
require_once '../../app/models/stock.model.php';
require_once '../../app/models/qr.model.php';

$session = new Session();
$user = new Staff();
$stock = new Stock();
$qr = new QR();

$user = $qr->getUserDetails($_POST['qr_code']);
$prescriptions = $qr->getUserPrescriptions($_POST['qr_code']);
$medicalAid = $qr->getUserMedicalAid($_POST['qr_code']);

?>

<div>

  <form>

    <!-- Hidden -->
    <?php
    foreach ($user as $key => $value) {
    ?>
      <input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
    <?php
    }
    ?>
    <!-- End Of Hidden -->
    <?php
    if ($user !== false) {
    ?>
      <h5>User</h5>
      <span class="text-success"><i class="fa fa-circle-check"></i>Found</span>
      Firstname: <?= $user['firstname']; ?><br>
      Surname: <?= $user['firstname']; ?>
    <?php
    } else {
    ?>
      User doesn't exist, please register or scan again <br>
      <button class="btn btn-primary" data-load="dispense-tab-1">New Customer</button>
    <?php
    }

    ?>
    <h5>Pescriptions</h5>
    <?php
    if ($prescriptions !== false) {
    ?>
      <span class="text-success"><i class="fa fa-circle-check"></i>Found</span>
    <?php
    } else {
    ?>
    <!-- Hidden -->
     <input type="hidden" name="presc_id" value="00000">
     <!-- End Of Hidden -->
      <span class="text-danger"><i class="fa fa-circle-xmark"></i>Not Found</span>
    <?php
    }
    ?>
    <h5>Medical Aid</h5>
    <?php
    if ($medicalAid !== false) {
    ?>
      <span class="text-success"><i class="fa fa-circle-check"></i>Found</span>
      <?php
      foreach ($medicalAid as $key => $value) {
      ?>
        <input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
      <?php
      }
    } else {
      ?>
      <span class="text-danger"><i class="fa fa-circle-xmark"></i>Not Found</span>
    <?php
    }
    ?>
    <div class="input-group justify-content-end">
      <button type="button" class="btn btn-primary" data-load="dispense-tab-2">Next</button>
    </div>
  </form>
</div>