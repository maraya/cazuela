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
	
	private static function createXMLBody($input, $elem) {
		
		foreach ($input as $key => $val) {
		
			if (is_array($val)) {
				if (is_numeric($key)) {
					$nval = array();
					$nval[$elem->tagName] = $val;
					self::createXMLBody($val, $elem->parentNode);
				} else {
			
					$child = self::$dom->createElement($key);
					$elem->appendChild($child);
					self::createXMLBody($val, $child);
					
					
				}
				
			} elseif (is_string($val)) {
			
				$child = self::$dom->createElement($key);
				$elem->appendChild($child);
				$text = self::$dom->createCDATASection($val);
				$child->appendChild($text);
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
	
		/*
		$input = array(
			array('val1' => 1),
			array('val2' => 2)
		);
		*/
		
		
		self::$dom = new DOMDocument('1.0', $charset);
		$root = self::$dom->createElement('root');
		self::$dom->appendChild($root);
		
		self::createXMLBody($input, $root);
		
		
		return self::$dom->saveXML();
		
		//echo self::$dom->saveXML();
		
		
		/*
		self::$xml = "<?xml version=\"1.0\" encoding=\"".$charset."\"?><root>";
		self::createXMLBody($input);		
		self::$xml .= "</root>";
		*/
		
		//return self::$xml;
	}
}
?>
