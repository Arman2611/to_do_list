<?php spl_autoload_register();

//use App\Routes\Router;
require_once './App/Routes/Router.php';

$url = strtok($_SERVER["REQUEST_URI"], '?');


use App\Routes\Router;
//echo "ZZZ";
(new Router())->route($url);

