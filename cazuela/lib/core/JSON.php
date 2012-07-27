<?php

/**
 * JSON class to encode strings
 * @author maraya
 *
 * Version: 0.1 (26 July 2012)
 */
class JSON {

	/**
	 * Transforms array to JSON format
	 * @param array $input
	 * @return string
	 */
	public static function encode($input) {
		return json_encode($input);
	}
}

?>