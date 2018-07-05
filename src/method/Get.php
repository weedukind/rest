<?php

namespace rest\method;

class Get extends \rest\Method {

	public function run() {

		if (NULL === $this->id) {

			throw Exception("FIXME");
		}
		try {

			$this->service->get($this->id);
		} catch (\Exception $e) { // FIXME
			$this->service->error(1, 'Cannot load entity "'.$id.'".');
		}
//		$this->service->out();
	}
}

