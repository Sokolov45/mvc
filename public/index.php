<?php
//spl_autoload_register(function ($classname) {
//    include "../app/controller/$classname.php";
//});
require_once '../vendor/autoload.php';


$parts = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = $parts[1];
$actionName = $parts[2];

$controllerFileName = 'app\controller\\' . ucfirst($controllerName);

//заменям инклуды автолоадером
//include "../app/controller/$controllerFileName.php";

$controllerObj = new $controllerFileName();

$actionFuncName = $actionName . 'Action';
if (!method_exists($controllerObj, $actionFuncName)) {
    echo "такого экшена нет";
    die;
}


$tpl = "../app/templates/" . ucfirst($controllerName) . '/' . $actionName . '.phtml';


//include "../core/View.php";
$view = new core\View();


$controllerObj->view = $view;

$controllerObj->$actionFuncName();
$view->render($tpl);
echo $view->render($tpl);




//
//$app = new core\Application();
//$app->run();
