<?php

class CazuelaRequest {
	private $class;
	private $method;
	private $type;

	public function setClass($class) {
		$this->class = ucfirst(strtolower(trim($class)));
	}
	
	public function setMethod($method) {
		$this->method = trim($method);
	}

	public function getClass() {
		return $this->class;
	}
	
	public function getMethod() {
		return $this->method;
	}
}

?>