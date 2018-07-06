<?php

namespace rest;

class Rest {

	protected static $VERSION = '1.0.9';
	protected $method = NULL;
	protected $service = NULL;
	protected $id = NULL;
	protected $data = NULL;
	protected $start = NULL;

	public function __construct() {
		$this->start = microtime(TRUE);
	}

	public function set_method(String $s) {
		$this->method = strtoupper($s);
	}

	public function set_service(String $s) {
		$class = '\rest\service\\'.ucfirst(strtolower($s));
		try {
			$this->service = new $class();
		} catch (\Throwable $e) {
			$this->error('Service "'.$s.'" is not supported.', 999);
		}
	}

	public function error($msg, $id) {
		$out = array(
			'error' => $id,
			'msg' => $msg
		);
		echo json_encode($out);
		exit();
	}

	public function set_id(String $s = NULL) {
		$this->id = $s;
	}

	public function set_data(String $s) {
		$this->data = $s;
	}

	public function run() {

		switch ($this->method) {
			case 'GET':
				$this->get();
				break;
			case 'PUT':
				$this->put();
				break;
			case 'POST':
				$this->post();
				break;
			case 'DELETE':
				$this->delete();
				break;
			default:
				throw new \Exception('unknown method "'.$this->method.'".', 999);
		}
 
		$out = array(
			'error' => 0,
			'version' => static::$VERSION,
			'time' => time(),
			'took' => microtime(TRUE) - $this->start,
			'response' => $this->service->get_out(),
		);
		echo json_encode($out);
	}

	protected function get() {

		if (NULL === $this->id) {

			throw Exception("FIXME");
		}
		try {

			$this->service->get($this->id);
		} catch (\Exception $e) { // FIXME
			$this->service->error(1, 'Cannot load entity "'.$id.'".');
		}
	}

	protected function put() {

		if (NULL === $this->id) {
			throw new \Exception('No id defined for PUT.', 999);
		} else {
			$this->service->put($this->id, $this->data);
		}
	}

	protected function post() {
		$this->service->post($this->data);
	}

	protected function delete() {

		if (NULL === $this->id) {

			throw Exception("FIXME");
		}
		$this->service->delete($this->id);
	}
}
