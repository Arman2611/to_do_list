<?php spl_autoload_register();

//use App\Routes\Router;

$url = strtok($_SERVER["REQUEST_URI"], '?');


use App\Routes\Router;

(new Router())->route($url);

