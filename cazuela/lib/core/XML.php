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
	 * Holds the XML string
	 * @var string
	 */
	private static $xml;
	
	/**
	 * Checks if a variable is an associative array
	 * @param array $arr
	 * @return void
	 */
	private static function isAssoc($arr) {
		if (!is_array($arr)) return true;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
	
	/**
	 * Gets the XML type for a native type
	 * @param mixed $val
	 * @return string
	 */
	private static function getXMLType($val) {
		$type = null;
		if (is_string($val)) {
			$type = "<![CDATA[".$val."]]>";
		} elseif (is_bool($val)) {
			$val = ($val === true)? 'true': 'false';
			$type = $val;
		} else {
			$type = $val;
		}
		return $type;
	}
	
	/**
	 * Creates XML body
	 * @param array $input
	 * @return void
	 */
	private static function createXMLBody($input) {
		
		foreach ($input as $key => $val) {		
			if (!self::isAssoc($val)) {
				
				foreach ($val as $arr) {
					self::$xml .= "<".$key.">";
					foreach ($arr as $key2 => $val2) {
						self::$xml .= "<".$key2.">".self::getXMLType($val2)."</".$key2.">";
					}
					self::$xml .= "</".$key.">";
				}
			} else {
				self::$xml .= "<".$key.">";
			
				if (is_array($val)) {
					self::$xml .= self::createXMLBody($val);
				} else {
					self::$xml .= self::getXMLType($val);
				}
			
				self::$xml .= "</".$key.">";
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
		
		$input = array(
			array('val1' => 1),
			array('val2' => 2)
		);
		self::$xml = "<?xml version=\"1.0\" encoding=\"".$charset."\"?><root>";
		self::createXMLBody($input);		
		self::$xml .= "</root>";
		
		return self::$xml;
	}
}
?>
