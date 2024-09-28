<?php


require_once '../../vendor/autoload.php';
require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/stock.model.php';


$stock = new Stock();

?>

<div>
  <form action="" method="post">
    <!-- Hidden -->
    <?php
    foreach ($_POST as $key => $value) {
    ?>
      <input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
    <?php
    }
    ?>
    <input type="hidden" name="items[]" values="[]" id="items">
    <!-- End Of Hidden -->
      <div>
        <h5>Name :<?= $_POST['firstname']; ?></h5>
      </div>

      <ul id="cart-items" class="list-group mb-3 w-100">
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0">Product name</h6>
            <small class="text-body-secondary">Brief description</small>
          </div>
          <span class="text-body-secondary">$12</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong id="cart-total">20</strong>
        </li>
      </ul>
      <div class="input-group">
        <select name="item" id="item" class="form-select">
          <?php
          $availableDrugs = $stock->availableDrugs();
          foreach ($availableDrugs as $drug) {
          ?>
            <option value='{"stock_id" :"<?= $drug['stock_id']; ?>", "price" :<?= $drug['price']; ?>, "name": "<?= $drug['name']; ?>"}'><?= $drug['name']; ?>(<?= $drug['price']; ?>)</option>
          <?php
          }
          ?>
        </select>
        <input type="number" name="qty" id="qty" class="form-control" min="1" value="1">
        <button type="button" class="dispense-item-add btn btn-primary">Add</button>
      </div>
      <div class="input-group">
        <button type="submit" class="btn btn-primary" name="sale" value="sale">Complete</button>
      </div>
  </form>
</div>