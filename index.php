<?php spl_autoload_register();

use App\Routes\Router;

$url = strtok($_SERVER["REQUEST_URI"], '?');

(new Router())->route($url);
