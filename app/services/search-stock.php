<?php


require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/stock.model.php';

$stock = new Stock();

if (isset($_POST['search_stock'])) {
  echo "Stupid";
  $drugs = $stock->searchDrugs($_POST['q']);
  var_dump($drugs);
  if ($drugs !== false) {
    foreach ($drugs as $stockItem) {
      ?>
      <tr>
      <td><?= $stockItem['stock_id']; ?></td>
      <td><?= $stockItem['name']; ?></td>
      <td colspan="3"><?= $stockItem['description']; ?></td>
      <td><?= $stockItem['threshold']; ?></td>
      <td><?= $stockItem['balance']; ?></td>
      <td><button class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></button></td>
      </tr>
      <?php
    }
  }
}

?>
