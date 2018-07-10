<?php

namespace rest;

class Service {

	protected $data = NULL;

	public function error ($id, $msg, $data = NULL) {
		$this->data['response'] = array(
			'id' => $id,
			'msg' => $msg,
			'data' => $data,
		);
	}

	public function get_out() {
		return $this->data;
	}

	public function get($id) {
		echo "GET\n";
		echo "ID: $id\n";
	}

	public function post($data) {
		echo "POST\n";
		print_r($data);
	}

	public function put($id, $data) {
		echo "PUT\n";
		echo "ID: $id\n";
		print_r($data);
	}

	public function delete($id) {
		echo "DELETE\n";
		echo "ID: $id\n";
	}
}

