<?php spl_autoload_register(function ($class) {
    require_once($class.'.php');
});

require_once 'App/test.php';

//use App\Routes\Router;
//
//$url = strtok($_SERVER["REQUEST_URI"], '?');
//
//(new Router())->route($url);
