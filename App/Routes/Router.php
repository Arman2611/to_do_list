<?php

namespace App\Routes;

use App\Middlewares\CookieCleaner;
use App\Controllers\TaskController;
use App\Controllers\MigrationController;

class Router
{
	public function route($url): void
	{
        (new CookieCleaner())->clean();

        match ($url) {
            '/' => (new TaskController())->index(),
            '/task/create' => (new TaskController())->create(),
            '/task/store' => (new TaskController())->store(),
            '/config/migrate' => (new MigrationController())->migrate(),
            default => (new TaskController())->notFound()
        };
	}
}