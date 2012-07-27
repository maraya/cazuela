<?php

/**
 * XML class to encode strings
 * @author maraya
 *
 * Version: 0.1 (26 July 2012)
 */

class XML {
	
	/**
	 * Transforms array to XML format
	 * @param array $input
	 * @param string $charset
	 * @return string
	 */
	public static function encode($input, $charset) {
		Array2XML::init('1.0', $charset);
		$xml = Array2XML::createXML('root', $input);
		
		return $xml->saveXML();
	}
}
?>