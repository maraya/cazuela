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
	 * Transforms array to XML format
	 * @param array $input
	 * @param string $charset
	 * @return string
	 */
	public static function encode($input, $charset) {
		$dom = new DOMDocument('1.0', $charset);
		$dom->formatOutput = true;
		$root = $dom->createElement('root');
		$dom->appendChild($root);
		
		$dom = self::createXMLBody($input, $root, $dom);
		
		return $dom->saveXML();		
	}
	
	/**
	 * Creates the XML body
	 * @param mixed $mixed
	 * @param DOMElement $elem
	 * @param DOMDocument $dom
	 * @return DOMDocument
	 */
	public static function createXMLBody($mixed, $elem = null, $dom = null) {
		if (is_array($mixed)) {
			foreach ($mixed as $index => $mixedElement) {
				if (is_int($index)) {
					if ($index == 0) {
						$node = $elem;
					} else {
						$node=$dom->createElement($elem->tagName);
						$elem->parentNode->appendChild($node);
					}
				} else {
					$node = $dom->createElement($index);
					$elem->appendChild($node);
				}
				self::createXMLBody($mixedElement, $node, $dom);
			}
		} else {
			if (is_string($mixed)) {
				$elem->appendChild($dom->createCDATASection($mixed));
			} else {
				$elem->appendChild($dom->createTextNode($mixed));
			}
		}
		
		return $dom;
	}
}
?>
