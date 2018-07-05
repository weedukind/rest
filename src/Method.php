<?php

namespace rest;

abstract class Method {

	protected $service = NULL;
	protected $id = NULL;
	protected $data = NULL;

	public function set_service($service) {
		$this->service = $service;
	}

	public function set_id(String $s = NULL) {
		$this->id = $s;
	}

	public function set_data(String $s = NULL) {
		$this->data = $s;
	}

	public abstract function run();
}

