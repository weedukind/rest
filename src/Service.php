<?php

namespace rest;

abstract class Service {

	protected $data = NULL;

	public abstract function get($id);
	public abstract function create($doc);
	public abstract function update($id, $doc);

	public function error ($id, $msg, $data = NULL) {
		$this->data['response'] = array(
			'id' => $id,
			'msg' => $msg,
			'data' => $data,
		);
	}

	public function get_out() {
		return $this->data;
//		echo json_encode($this->data);
	}
}

