<?php


require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/stock.model.php';

$stock = new Stock();

if (isset($_POST['add_stock'])) {
  if ($stock->addStock($_POST['stock_id'], $_POST)) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> New stock added for stock <b><?= $_POST['stock_id']; ?></b>, please reload to see changes.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Stock could not be added for <b><?= $_POST['stock_id']; ?></b>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
  }
}

?>