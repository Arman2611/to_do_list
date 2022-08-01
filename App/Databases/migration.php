<?php

// Connecting to database
require_once './src/configuration/Database.php';

// Connecting services
require_once './src/services/createDB.php';
require_once './src/services/useDB.php';
require_once './src/services/createTable.php';

try {
	(new Connection())->open();
	createDB('myDB');
	useDB('myDB');
	createTable('users');
	setcookie('PHPSESSID', null, -1, '/');
} catch (Exception $err) {
	echo $err;
}