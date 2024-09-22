<?php

require_once '../vendor/autoload.php';

require_once '../app/config/config.php';
require_once '../app/models/db.model.php';
require_once '../app/models/session.model.php';

$session = new Session();


if(isset($_SESSION['user_is_logged_in'])) {
    header("Location: " . $_ENV['ROOT'] . "dashboard/" . $_SESSION['user_type'] . "/index.php");
} else {
    header("Location: " . $_ENV['ROOT'] . "/login.php?error=error_login");
}


?>

?>