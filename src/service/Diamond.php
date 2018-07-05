<?php

namespace rest\service;

class Diamond extends \rest\Service {

	public function get($id) {

		$m = \oc\model\Diamond::load_instance($id);
		$this->data = $m->get();
	}

	public function create($data) {

		$data = json_decode($data, TRUE);

		$e = new \oc\model\Diamond($data);
		$e->store();
	}

	public function update($id, $data) {

		$data = json_decode($data, TRUE);
		$data['_id'] = $id;

		$e = new \oc\model\Diamond($data);
		$e->store();
	}
}
