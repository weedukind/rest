<?php

namespace rest;

abstract class Method {

	protected $service = NULL;

	public function __construct($service) {
		$this->service = $service;
	}

	public abstract function run($id);
}

