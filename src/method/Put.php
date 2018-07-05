<?php

namespace rest\method;

class Put extends \rest\Method {

	public function run() {

		if (NULL === $this->id) {
			$this->service->create($this->data);
		} else {
			$this->service->update($this->id, $this->data);
		}
//		$this->service->out();
	}

}

