<?php

/**
 * A class to handle the client request
 * It should be instanciated only by the Dispatcher
 * @author maraya
 *
 * Version: 0.1 (26 July 2012)
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
	 * @param string $class - name of the class
	 */
	public function setClass($class) {
		$this->class = trim($class);
	}
	
	/**
	 * Sets the method name
	 * @param string $method - name of the method
	 */
	public function setMethod($method) {
		$this->method = trim($method);
	}
	
	/**
	 * Sets the parameters
	 * @param array $params - array of params (name/value)
	 */
	public function setParams($params) {
		ksort($params);		
		$this->params = $params;
	}
	
	/**
	 * Gets the class name
	 * @return string
	 */
	public function getClass() {
		return $this->class;
	}
	
	/**
	 * Gets the method name
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}
	
	/**
	 * Gets the parameters
	 * @return array
	 */
	public function getParams() {
		return $this->params;
	}
}

?>