<?php

class CazuelaResponse {
	private $type;
	private $data;
	private $message;
	private $error;
	private $contentType;
	private $charset;
	
	public function __construct($options = array()) {
		if (isset($options['charset'])) {
			$this->charset = $options['charset'];
		}
	}
	
	public function setType($type) {
		$this->type = trim($type);
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setData($data) {
		$this->data = $data;
	}
	
	public function getData() {
		return $this->data;
	}
	
	public function setMessage($message) {
		$this->message = $message;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function setCode($code) {
		$this->code = $code;
	}
	
	public function getCode() {
		return $this->code;
	}
	
	public function setError($error) {
		$this->error = true;
	}
	
	public function error() {
		return $this->error;
	}
	
	public function setContentType($type) {
		if ($type == "json") {
			$this->contentType =  "application/json";
		} else if ($type == "xml") {
			$this->contentType = "application/xml";
		}
	}
	
	public function getContentType() {
		return $this->contentType;
	}
	
	public function setCharset($charset) {
		$this->charset = $charset;
	}
	
	public function getCharset() {
		return $this->charset;
	}
	
	public function getResponse($output) {
		if (Configure::read('debug') == 1) {
			$output['debug'] = CazuelaDebug::get();
		}
		
		if ($this->type == "json") {
			$output = JSON::get($output);
		} else if ($this->type == "xml") {
			$output = XML::get($output, $this->getCharset());
		} else { // default
			$output = JSON::get($output);
		}
		
		return $output;
	}
}

?>