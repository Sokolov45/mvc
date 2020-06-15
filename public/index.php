<?php
require_once "../vendor/autoload.php";
use core\Application;
use controllers\User;
require_once "../core/config.php";
include "../app/controllers/User.php";
include "../core/Application.php";


$app = new Application();
$app->run();
