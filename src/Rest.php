<?php

namespace rest;

class Rest {

	protected $method = NULL;
	protected $service = NULL;
	protected $id = NULL;

	public function __construct(String $method, String $service, String $id = NULL) {

		$this->method  = $method;
		$this->service = $service;
		$this->id      = $id;
	}

	public function run() {

		$class = '\rest\service\\'.ucfirst(strtolower($this->service));
		$service = new $class();

		$class = '\rest\method\\'.ucFirst(strtolower($this->method));
		$method = new $class($service);

		$method->run($this->id);
	}
}
