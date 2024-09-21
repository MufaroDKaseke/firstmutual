<?php


require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/stock.model.php';


$stock = new Stock();

var_dump($stock->drugIsAvailable('32938'));