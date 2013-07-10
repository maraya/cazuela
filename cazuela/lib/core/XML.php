<?php

/**
 * XML class to encode strings
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Cazuela. If not, see <http://www.gnu.org/licenses/>.
 */

class XML {
	/**
	 * Holds the DOMDocument object
	 * @var DOMDocument
	 */
	private static $dom;
	
	/**
	 * Creates the XML body
	 * @param array $input
	 * @param DOMElement $elem
	 * @return void
	 */
	private static function createXMLBody($input, $elem) {
	
		//print_r($input);
	
		$numKeys = array_filter(array_keys($input), function($k) {
			return is_int($k);
		});
		
		if (sizeof($numKeys) == sizeof($input)) {
			foreach ($input as $val) {
				$child = self::$dom->createElement($elem->tagName, $val);
				$elem->appendChild($child);
			}
		} else {	
			foreach ($input as $key => $val) {
				if (is_array($val)) {
					$numKeys = array_filter(array_keys($val), function($k) {
						return is_int($k);
					});
					
					if (sizeof($numKeys) > 0) {
						foreach ($numKeys as $index) {
							$child = self::$dom->createElement($key);
							self::createXMLBody($input[$key][$index], $child);
							$elem->appendChild($child);
						}
						
					} else {
						$child = self::$dom->createElement($key);
						self::createXMLBody($val, $child);
						$elem->appendChild($child);
					}
				
				} elseif (is_string($val)) {
					$child = self::$dom->createElement($key);
					$elem->appendChild($child);
					$text = self::$dom->createCDATASection($val);
					$child->appendChild($text);
				} else {
					$child = self::$dom->createElement($key, $val);
					$elem->appendChild($child);
				}
			}
		}
	}
	
	/**
	 * Transforms array to XML format
	 * @param array $input
	 * @param string $charset
	 * @return string
	 */
	public static function encode($input, $charset) {
		
		//$input = array(1, 2, 3, 4, 5, 6);
		
		
		self::$dom = new DOMDocument('1.0', $charset);
		$root = self::$dom->createElement('root');
		self::$dom->appendChild($root);		
		self::createXMLBody($input, $root);
		
		return self::$dom->saveXML();
	}
}
?>
