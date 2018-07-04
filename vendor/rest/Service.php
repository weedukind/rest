<?php

namespace rest;


abstract class Service {

	protected $data = NULL;

	public abstract function get($id);

	public function out() {
		echo json_encode($this->data);
	}
}

