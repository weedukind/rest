<?php

namespace rest\method;

class Delete extends \rest\Method {

	public function run() {

		if (NULL === $this->id) {

			throw Exception("FIXME");
		}
		$this->service->delete($this->id);
	}
}

