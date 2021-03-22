<?php

use Base\Route;

include "../vendor/autoload.php";

$parts = parse_url($_SERVER['REQUEST_URI']);

$route = new Route();
$route->