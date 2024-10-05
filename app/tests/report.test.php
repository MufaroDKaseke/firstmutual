<?php

require_once '../../vendor/autoload.php';
require_once '../config/config.php';
require_once '../models/db.model.php';
require_once '../models/report.model.php';


$report = new Report();
var_dump($report->totalUsers());
