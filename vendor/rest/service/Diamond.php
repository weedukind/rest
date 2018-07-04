<?php

namespace rest\service;

class Diamond extends \rest\Service {
	public function get($id) {
		$m = \oc\model\Diamond::load_instance($id);
		$this->data = $m->get();
	}
}

