<?php

require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/session.model.php';
require_once '../../app/models/admin.model.php';
require_once '../../app/models/stock.model.php';
require_once '../../app/models/qr.model.php';

$session = new Session();
$user = new Admin();
$stock = new Stock();
$qr = new QR();

echo $_SESSION['username'];
?>