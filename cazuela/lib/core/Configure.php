<?php

/** 
 * Configure class
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */

class Configure {
	/**
	 * Hold the items array
	 * @var array
	 */
	private static $items;
	
	/**
	 * Write conf value
	 * @param string $name
	 * @param string $value
	 */
	public static function write($name, $value) {
		self::$items[$name] = $value;
	}
	
	/**
	 * Gets conf value, null if key does not exists
	 * @param string $name
	 * @return string
	 */
	public static function read($name) {
		/*
		if (is_null(self::$items)) {
			return null;	
		}
		*/
		
		if (array_key_exists($name, self::$items) === false) {
			return null;
		}
		
		return self::$items[$name];
	}
}
?>
