<?php

/**
 * A class to handle the client request
 * It should be instanciated only by the Dispatcher
 * @author maraya
 * 
 * This file is part of Cazuela.
 *
 * Cazuela is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Cazuela is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Cazuela. If not, see <http://www.gnu.org/licenses/>.
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
	 * CazuelaRequest static instance
	 * @var CazuelaRequest
	 */
	private static $instance = null;
	
	/**
	 * CazuelaRequest construct
	 */
	public function __construct() {
		if (self::$instance == null) {
			self::$instance = $this;
		} else {
			return self::$instance;
		}
	}
	
	/**
	 * Gets the CazuelaRequest instance
	 * @return CazuelaRequest
	 */
	public static function getInstance() {
		return self::$instance;
	}
	
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
	
	/**
	 * Check the request type
	 * @param string $type
	 * @return array
	 */
	public function is($type) {
		$type = strtoupper($type);
		
		if (!isset($_SERVER['REQUEST_METHOD'])) {
			return false;
		} elseif ($_SERVER['REQUEST_METHOD'] === $type) {
			return true;
		}
		
		return false;
	}
}

?>