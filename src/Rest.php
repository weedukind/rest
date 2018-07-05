<?php

namespace rest;

class Rest {

	protected static $VERSION = '1.0.7';
	protected $method = NULL;
	protected $service = NULL;
	protected $id = NULL;
	protected $data = NULL;
	protected $start = NULL;

	public function __construct() {
		$this->start = microtime(TRUE);
	}

	public function set_method(String $s) {
		$class = '\rest\method\\'.ucFirst(strtolower($s));
		$this->method = new $class();
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

		$this->method->set_service($this->service);
		$this->method->set_id($this->id);
		$this->method->set_data($this->data);
		$this->method->run($this->id);

		$out = array(
			'error' => 0,
			'version' => static::$VERSION,
			'time' => time(),
			'took' => microtime(TRUE) - $this->start,
			'response' => $this->service->get_out(),
		);
		echo json_encode($out);
	}
}
