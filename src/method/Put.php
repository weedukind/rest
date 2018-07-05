<?php

namespace rest\method;

class Put extends \rest\Method {

	public function run() {

		if (NULL === $this->id) {
			throw new \Exception('No id defined for PUT.', 999);
		} else {
			$this->service->put($this->id, $this->data);
		}
	}

}
