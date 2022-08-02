<?php
spl_autoload_register(function ($class) {
    require_once($class.'.php');
});

$url = strtok($_SERVER["REQUEST_URI"], '?');

(new App\Routes\Router())->route($url);
