<?php spl_autoload_register(function ($class) {
    require_once($class.'.php');
});

use App\Routes\Router;

$url = strtok($_SERVER["REQUEST_URI"], '?');

(new Router())->route($url);
