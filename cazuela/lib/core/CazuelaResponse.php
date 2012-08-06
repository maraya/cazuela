<?php

/**
 * A class to handle the client response
 * It should be instanciated only by the Dispatcher
 * @author maraya
 *
 * Version: 0.1 (26 July 2012)
 */

class CazuelaResponse {
	/**
	 * Holds the type/format name (json/xml/yml)
	 * @var type
	 */
	private $type;
	
	/**
	 * Holds the response data
	 * @var data
	 */
	private $data;
	
	/**
	 * Holds the message (if any error ocurred)
	 * @var message
	 */
	private $message;
	
	/**
	 * Holds the error code (if any error ocurred)
	 * @var error
	 */
	private $code;
	
	/**
	 * Holds the error flag (if any error ocurred)
	 * @var error
	 */
	private $error;
	
	/**
	 * Holds the output content type name
	 * @var contentType
	 */
	private $contentType;
	
	/**
	 * Holds the output charset
	 * @var charset
	 */
	private $charset;
	
	/**
	 * Holds the array response
	 * @var response
	 */
	private $response;
	
	/**
	 * Construct
	 * @param array $options - array options
	 */
	public function __construct($options = array()) {
		if (isset($options['charset'])) {
			$this->charset = $options['charset'];
		}
	}
	
	/**
	 * Sets the type/format name
	 * @param string $type - sets the type/format name (json/xml/yml)
	 */
	public function setType($type) {
		$this->type = trim($type);
	}
	
	/**
	 * Gets the type/format name
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * Sets the class-method return data
	 * @param array $data
	 */
	public function setData($data) {
		$this->data = $data;
	}
	
	/**
	 * Gets the class-method return data
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Sets the message (if any error ocurred)
	 * @param string $message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}
	
	/**
	 * Gets the message (if any error ocurred)
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 * Sets the error code (if any error ocurred)
	 * @param int $code - error code
	 */
	public function setCode($code) {
		$this->code = $code;
	}
	
	/**
	 * Gets the error code (if any error ocurred)
	 * @return int
	 */
	public function getCode() {
		return $this->code;
	}
	
	/**
	 * Sets the error flag (if any error ocurred)
	 * @param boolean $error
	 */
	public function setError($error) {
		$this->error = $error;
	}
	
	/**
	 * Gets the error flag (if any error ocurred)
	 * @return boolean
	 */
	public function error() {
		return $this->error;
	}
	
	/**
	 * Sets the response content-type
	 * @params string $type - json or xml
	 */
	public function setContentType($type) {
		if ($type == "json") {
			$this->contentType =  "application/json";
		} else if ($type == "xml") {
			$this->contentType = "application/xml";
		} else if ($type == "yml") {
			$this->contentType = "text/x-yaml";
		}
	}
	
	/**
	 * Gets the response content-type
	 * @return string $type
	 */
	public function getContentType() {
		return $this->contentType;
	}
	
	/**
	 * Sets the response charset
	 * @param string $charset
	 */
	public function setCharset($charset) {
		$this->charset = $charset;
	}
	
	/**
	 * Gets the response charset
	 * @return string
	 */
	public function getCharset() {
		return $this->charset;
	}
	
	/**
	 * Sets the response array
	 * @param array $response
	 */
	public function setResponse($response) {
		$this->response = $response;
	}
	
	/**
	 * Gets the response array
	 * @return array
	 */
	public function getResponse() {
		return $this->response;
	}
	
	/**
	 * Gets the output JSON/XML/YAML
	 * @return string
	 */
	public function getOutput() {
		$output = $this->getResponse();
	
		if (Configure::read('debug') == 1) {
			$output['debug'] = CazuelaDebug::get();	
		}
		
		if ($this->type == "json") {
			$output = JSON::encode($output);
		} else if ($this->type == "xml") {
			$output = XML::encode($output, $this->getCharset());
		} else if ($this->type == "yml") {
			$output = YAML::encode($output);
		} else { // default
			$output = JSON::encode($output);
		}
		
		return $output;
	}
}

?>