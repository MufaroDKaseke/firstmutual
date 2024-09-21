<?php


require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/qr.model.php';

$qr = new QR();
var_dump($qr->getUserDetails('934394'));