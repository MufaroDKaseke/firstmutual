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


    <div class="qr-results">
      <div class="d-flex flex-column align-items-center">
        <?php
        if ($user !== false) {
          foreach ($user as $key => $value) {
        ?>
            <!-- Hidden -->
            <input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
            <!-- End Of Hidden -->
          <?php
          }
          ?>
          <i class="fas fa-circle-user fa-3x mb-3"></i>
          <h4 class="text-center text-success mb-4"><i class="fa fa-circle-check"></i> User Found</h4>

          <div style="width: fit-content;">
            <?php
            if ($prescriptions !== false) {
            ?>
              <h5>Pescriptions : <span class="text-success"><i class="fa fa-circle-check me-2"></i>Found</span></h5>
              <ul class="list-group mb-2">
                <?php
                foreach ($prescriptions as $prescription) {
                ?>
                  <li class="list-group-item">
                    <?= $prescription['uploaded_on']; ?>
                    <img src="data:image/png;base64,<?= $prescription['img']; ?>" alt="" width="50px" class="img-fluid">
                    <button type="button" class="display-prescription btn btn-sm btn-primary" data-presc-id="<?= $prescription['presc_id']; ?>"><i class="fa fa-eye"></i> View</button>
                  </li>
                <?php
                }
                ?>
              </ul>
            <?php
            } else {
            ?>
              <!-- Hidden -->
              <input type="hidden" name="presc_id" value="00000" id="presc_id">
              <!-- End Of Hidden -->
              <h5>Prescriptions : <span class="text-primary"><i class="fa fa-circle-xmark me-2"></i> Not Found</span></h5>
            <?php
            }
            ?>
            <?php
            if ($medicalAid !== false) {
            ?>
              <input type="hidden" name="has_medical_aid" value="true">
              <h5>Medical Aid : <span class="text-success"><i class="fa fa-circle-check me-2"></i>Found</span></h5>

              <?php
              foreach ($medicalAid as $key => $value) {
              ?>
                <input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
              <?php
              }
            } else {
              ?>
              <h5>Medical Aid : <span class="text-primary"><i class="fa fa-circle-xmark me-2"></i> Not Found</span></h5>
          </div>
        <?php
            }
          } else {
        ?>
        <i class="fas fa-circle-user fa-3x mb-3"></i>
        <h4 class="text-center text-primary"><i class="fa fa-circle-check"></i>Invalid QR code</h4>
        <div class="text-center">
          <button class="btn btn-primary" data-load="dispense-tab-2 me-2">Skip</button>
          <button class="btn btn-primary" data-load="dispense-tab-1">New Customer</button>
        </div>
      <?php
          }
      ?>
      </div>
    </div>
    <div class="input-group justify-content-end">
      <button type="button" class="btn btn-primary" data-load="dispense-tab-2">Start Cart</button>
    </div>
  </form>
</div>