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