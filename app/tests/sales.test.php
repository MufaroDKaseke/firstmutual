<?php

require_once '../../vendor/autoload.php';
require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/session.model.php';
require_once '../models/sales.model.php';

echo $_SESSION['staff_id'];

$sale = new Sales();

$formData = ['presc_id' => '23232', 'items' => [['stock_id' => '32323', 'price' => 23.2, 'quantity' => 12], ['stock_id' => '55543', 'price' => 7, 'quantity' => 10]]];
var_dump($sale->newEntry($formData));
