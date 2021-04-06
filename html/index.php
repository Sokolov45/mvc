<?php
//этот файл назвается исполняемый файл =)
use Base\Application;
use Base\Route;
use Base\RouteException;

include '../src/config.php';

include "../vendor/autoload.php";

$app = new Application();
$app->run();


/*непонятки
1.

*/