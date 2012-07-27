<?php

/** 
 * Debug class (only called if debug flag is set to 1 in Config.php file)
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */

class CazuelaDebug {
	/**
	 * Holds the debug array
	 * @var array
	 */
	private static $log = array();
	
	/**
	 * Append to debug array list
	 * @param string $key
	 * @param strng $value
	 */
	public static function append($key, $value) {
		self::$log[] = array($key => $value);
	}
	
	/**
	 * Returns the debug array list
	 * @return array
	 */
	public static function get() {
		return self::$log;
	}
}

?>