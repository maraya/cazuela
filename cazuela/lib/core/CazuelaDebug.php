<?php

class CazuelaDebug {
	private static $log = array();
	
	public static function append($key, $value) {
		self::$log[] = array($key => $value);
	}
	
	public static function get() {
		return self::$log;
	}
}

?>