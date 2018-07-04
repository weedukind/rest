<?php

require_once __DIR__ . '/vendor/autoload.php';

(new \rest\Rest('GET', 'Index', "ID"))->run();
