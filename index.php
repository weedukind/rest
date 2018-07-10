<?php

require_once __DIR__ . '/../../autoload.php';

$rest = new \rest\Rest();
$rest->set_method('GET');
$rest->set_service('\rest\Service');
$rest->set_id(123);
$rest->set_data('TEST');
$rest->run();
