<?php

namespace rest;

class Rest {

	protected static $VERSION = '1.0.11';
	protected $method = NULL;
	protected $service = NULL;
	protected $action = NULL;
	protected $id = NULL;
	protected $params = [];
	protected $session = NULL;
	protected $data = NULL;
	protected $start = NULL;

	public function __construct() {
		$this->start = microtime(TRUE);
	}

	public function set_method(String $s) {
		$this->method = strtoupper($s);
	}

	public function set_service(String $s) {

		$class = $s;

		try {
			$this->service = new $class();
		} catch (\Throwable $e) {
			$this->error('Service "'.$s.'" not found.', 999);
		}

		if (!is_subclass_of($this->service, '\rest\Service')) {
			echo get_class($this->service);
			if ('rest\Service' !== get_class($this->service)) {
				$this->error('Service "'.$s.'" not found (2).', 999);
			}
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

	public function set_action(String $s = NULL) {
		$this->action = $s;
	}

	public function set_params($a = []) {
		$this->params = $a;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_action() {
		return $this->action;
	}

	public function get_params() {
		return $this->params;
	}

	public function get_data() {
		return $this->data;
	}

	public function get_session() {
		return $this->session;
	}

	public function set_session(String $s = NULL) {
		$this->session = $s;
	}

	public function set_data( $s) { // we really want array here!
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
			case 'PATCH':
				$this->patch();
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
			// list
			$this->service->list($this);
			return;
		}

		// get one by id
		try {
//			$this->service->get($this->id);
			$this->service->get($this);
		} catch (\Exception $e) {
			$this->service->error(1, 'Cannot load entity "'.$id.'".');
		}
	}

	protected function patch() {

		if (NULL === $this->id) {
			throw new \Exception('No id defined for PATCH.', 999);
		} else {
			$this->service->patch($this);
		}
	}

	protected function put() {

		if (NULL === $this->id) {
			throw new \Exception('No id defined for PUT.', 999);
		} else {
			$this->service->put($this);
		}
	}

	protected function post() {
		$this->service->post($this);
	}

	protected function delete() {

		if (NULL === $this->id) {

			throw Exception("FIXME");
		}
		$this->service->delete($this);
	}

	public static function parse_body(&$body) {

		preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
		$boundary = $matches[1];

		unset($matches);
		$blox = preg_split("/-+$boundary/", file_get_contents('php://input'));
//		unset ($boundary);
		array_pop($blox);

		foreach ($blox as $id => $block) {

			if (empty($block)) {
				continue;
			}
			$data = preg_split('/\n\r/', $block);
			$header = strtolower($data[0]);
			$content = trim($data[1]);
			unset($data);
			$header = str_replace(': ', $boundary, $header);

			$matches = preg_split('/;?\s/', $header);

			$config = [];
			foreach ($matches as $head) {
				$head = str_replace($boundary, '=', $head);
				$head = trim($head);
				$head = preg_split('/[:=] ?/', $head);
				if (2 !== count($head)) {
					continue;
				}
				$key = $head[0];
				$value = $head[1];
				$value = preg_replace('/^"/', '', $value);
				$value = preg_replace('/"$/', '', $value);
				$config[$key] = $value;
			}

			$body[$config['name']] = $config;
			$body[$config['name']]['content'] = $content;
		}
	}
}
