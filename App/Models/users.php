<?php
	$schema = [
		'user_id' => 'BIGINT PRIMARY KEY',
		'name' => 'VARCHAR(30) NOT NULL',
		'surname' => 'VARCHAR(30) NOT NULL',
		'email' => 'VARCHAR(50) NOT NULL',
		'password' => 'TEXT NOT NULL'
	];
	return $schema;