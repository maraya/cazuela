<?php

/** 
 * Configure class
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

class Configure {
	/**
	 * Hold the items array
	 * @var array
	 */
	private static $items;
	
	/**
	 * Write conf value
	 * @param string $name
	 * @param string $value
	 */
	public static function write($name, $value) {
		self::$items[$name] = $value;
	}
	
	/**
	 * Gets conf value, null if key does not exists
	 * @param string $name
	 * @return string
	 */
	public static function read($name) {
		if (array_key_exists($name, self::$items) === false) {
			return null;
		}
		
		return self::$items[$name];
	}
}
?>
