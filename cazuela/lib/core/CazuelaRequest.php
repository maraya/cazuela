<?php

/**
 * CazuelaRequest class is the request.
 * It should be instanciated only by the Dispatcher
 * @author maraya
 *
 */

class CazuelaRequest {
	/**
	 * Holds the class name
	 * @var class
	 */
	private $class;
	
	/**
	 * Holds the method name
	 * @var method
	 */
	private $method;
	
	/**
	 * Holds the type/format name (json/xml)
	 * @var type
	 */
	private $type;
	
	/**
	 * Holds the query string params
	 * @var params
	 */
	private $params;
	
	/**
	 * Sets the class name
	 * @param string $class
	 */
	public function setClass($class) {
		$this->class = ucfirst(strtolower(trim($class)));
	}
	
	public function setMethod($method) {
		$this->method = trim($method);
	}
	
	public function setParams($params) {
		ksort($params);		
		$this->params = $params;
	}
	
	public function getClass() {
		return $this->class;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
	public function getParams() {
		return $this->params;
	}
}

?>