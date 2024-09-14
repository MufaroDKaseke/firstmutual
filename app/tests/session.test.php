<?php


require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/session.model.php';



$session = new Session();
var_dump($session->login('admin', 'momo', 'momoliciou'));
