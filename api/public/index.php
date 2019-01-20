<?php

declare(strict_types=1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,HEAD,OPTIONS');
header('Access-Control-Allow-Headers: Origin,Content-Type,Accept,Authorization');

echo json_encode([
	'name' => 'App Api',
	'version' => '1.0'
]);