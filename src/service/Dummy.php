<?php

namespace rest\service;

class Dummy extends \rest\Service {

	public function get($id) {
echo "GET\n";
	}

	public function post($data) {
echo "POST\n";
	}

	public function put($id, $data) {
echo "PUT\n";
	}
}
