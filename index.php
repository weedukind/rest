<?php

require_once __DIR__ . '/../../autoload.php';

$rest = new \rest\Rest();
$rest->set_method("POST");
$rest->set_service("dummy");
$rest->set_id(123);
$rest->set_data('{"clarity":1,"cut"2}');
$rest->run();
