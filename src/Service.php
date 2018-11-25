<?php

namespace rest;

class Service {

	protected $data = NULL;

	public function error ($id, $msg, $data = NULL) {
		$this->data['error'] = array(
			'id' => $id,
			'msg' => $msg,
			'data' => $data,
		);
	}

	public function get_out() {
		return $this->data;
	}

//	public function get($id) {
	public function get(\rest\Rest $rest) {
		echo "GET\n";
		echo "ID: ".$rest->get_id()."\n";
	}

	public function post(\rest\Rest $rest) {
		echo "POST\n";
		print_r($rest->get_params());
	}

	public function put(\rest\Rest $rest) {
		echo "PUT\n";
		echo "ID: ".$rest->id."\n";
	}

	public function delete(\rest\Rest $rest) {
		echo "DELETE\n";
		echo "ID: $id\n";
	}
}
