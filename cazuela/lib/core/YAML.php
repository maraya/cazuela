<?php

/**
 * YAML class to encode strings
 * @author maraya
 *
 * Version: 0.1 (26 July 2012)
 */

class YAML {
	
	/**
	 * Transforms array to YAML format
	 * @param array $input
	 * @return string
	 */
	public static function encode($input) {
		return yaml_emit($input);
	}
}
?>