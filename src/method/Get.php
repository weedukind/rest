<?php

namespace rest\method;

class Get extends \rest\Method {

	public function run($id = NULL) {

		if (NULL === $id) {
			throw Exception("FIXME");
		}
		$this->service->get($id);
		$this->service->out();
	}
}

