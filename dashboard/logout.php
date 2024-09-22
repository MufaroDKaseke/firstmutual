<?php

require_once '../vendor/autoload.php';

require_once '../app/config/config.php';
require_once '../app/models/db.model.php';
require_once '../app/models/session.model.php';

$session = new Session();


if ($session->logout()) {
    echo 'Successfully logged out';
} else {
    echo 'Still logged in';
}

?>