<?php


require_once '../../vendor/autoload.php';
require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/stock.model.php';

$db = new Database();
$stock = new Stock();

?>

<div>
  <form>
    <!-- Hidden -->
    <?php

    if (isset($_POST['register-user']) && !empty($_POST['firstname']) && !empty($_POST['surname']) && !empty($_POST['nat_id_number'])) {
      $db->connect();
      do {
        $userId = generateId('usr_');
        $result = mysqli_query($db->db_conn, "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'");
      } while (mysqli_num_rows($result) > 0);

      $username = strtolower($_POST['firstname']) . strtolower($_POST['surname']);
      $_POST['date'] = '1990-01-01';
      $_POST['med_aid'] = null;
      $stmt = mysqli_prepare($db->db_conn, "INSERT INTO tbl_users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)");
      mysqli_stmt_bind_param($stmt, 'sssssssss', $userId, $username, $_POST['nat_id_number'], $_POST['firstname'], $_POST['surname'], $_POST['nat_id_number'], $_POST['date'], $_POST['phone_number'], $_POST['email']);
      $result = mysqli_stmt_execute($stmt);

      if ($result) {
        $_POST['user_id'] = $userId;
    ?>
        <div class="alert alert-success my-2 py-2" role="alert"><i class="fa fa-circle-check me-2"></i>New pharmacy customer registered, username is firstname in lowercase and password is ID number!</div>
      <?php
      } else {
      ?>
        <div class="alert alert-warning my-2 py-2" role="alert"><i class="fa fa-circle-xmark me-2"></i>New pharmacy customer could not be registered, please use web portal!</div>
      <?php
      }
    }
    foreach ($_POST as $key => $value) {
      ?>
      <input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
    <?php
    }
    ?>
    <input type="hidden" name="items" value="[]" id="items">
    <!-- End Of Hidden -->
    <div>
      <h6 class="text-secondary">FullName : 
        <?php
        if (!empty($_POST['firstname'])) {
          echo $_POST['firstname'] . ' ' . $_POST['surname'];
        } else {
          echo "N/A";
        }
        ?>
      </h6>
      <h6 class="text-secondary">Medical Aid :
        <?php
        if (isset($_POST['has_medical_aid'])) {
          echo $_POST['med_id'];
        } else {
          echo 'N/A';
        }
        ?>
      </h6>
      <h6 class="text-secondary">Prescription : <?=$_POST['presc_id'];?></h6>
    </div>

    <ul id="cart-items" class="list-group mb-3 w-100">
      <!--<li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0">Product name</h6>
            <small class="text-body-secondary">x (quantity)</small>
          </div>
          <span class="text-body-secondary">$12</span>
        </li>-->
      <li class="list-group-item d-flex justify-content-between">
        <span>Total (USD)</span>
        <strong id="cart-total">USD$ <span class="cart-total-value">0</span></strong>
      </li>
    </ul>
    <div class="input-group">
      <select name="item" id="item" class="form-select">
        <?php
        $availableDrugs = $stock->availableDrugs();
        foreach ($availableDrugs as $drug) {
        ?>
          <option value='{"stock_id" :"<?= $drug['stock_id']; ?>", "price" :<?= $drug['price']; ?>, "name": "<?= $drug['name']; ?>"}'><?= $drug['name']; ?> ($<?= $drug['price']; ?>)</option>
        <?php
        }
        ?>
      </select>
      <input type="number" name="qty" id="qty" class="form-control" min="1" value="1">
      <button type="button" class="dispense-item-add btn btn-primary">Add</button>
    </div>
    <hr class="bg-primary">
    <div class="input-group my-2 justify-content-end">
      <button type="button" class="btn btn-primary" data-load="dispense-tab-3">Choose Payment Method</button>
    </div>
  </form>
</div>