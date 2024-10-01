<?php

//require_once '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

function generateId($prefix=null) {
  $a = '';
  for ($i = 0; $i < 6; $i++) {
    $a .= mt_rand(0, 9);
  }

  return ($prefix === null) ? $a : $prefix . $a;
  
}