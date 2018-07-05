<?php

namespace rest\method;

class Post extends \rest\Method {

	public function run() {

		$this->service->post($this->data);
	}

}
