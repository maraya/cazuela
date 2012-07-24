<?php

class Configure {
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
