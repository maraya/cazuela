<?php

/** 
 * Configure class
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */

class Configure {
	/**
	 * Enter description here ...
	 * @var array
	 */
	private static $items;
	
	public static function write($name, $value) {
		self::$items[$name] = $value;
	}
	
	public static function read($name) {
		if (!array_key_exists($name, self::$items)) {
			return null;
		}
		
		return self::$items[$name];
	}
}
?>
