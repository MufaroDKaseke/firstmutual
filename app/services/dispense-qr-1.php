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

?>

<div>

  <?php
    if ($user !== false) {
      ?>
      <h5>User</h5>
      Firstname: <?=$user['firstname'];?><br>
      Surname: <?=$user['firstname'];?>
      <?php
    } else {
      ?>
      User doesn't exist, please register or scan again <br>
      <button class="btn btn-primary" data-load="dispense-tab-1">New Customer</button>
      <?php
    }

  ?>
  <h5>Pescriptions</h5>
  <h5>Medical Aid</h5>
</div>