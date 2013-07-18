<?php

/**
 * Cazuela Cache class
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Cazuela. If not, see <http://www.gnu.org/licenses/>.
 */

class CazuelaCache {
	/**
	 * Holds the engine connection
	 * @var resource
	 */
	private $conn;
	
	/**
	 * Holds the engine configuration
	 * @var array
	 */
	private $cacheEngine;
	
	/**
	 * CazuelaCache static instance
	 * @var CazuelaCache
	 */
	private static $instance = null;
	
	/**
	 * CazuelaCache Construct
	 */
	public function __construct() {		
		if (self::$instance == null) {
			$this->cacheEngine = Configure::read('cacheEngine');
			
			if ($this->cacheEngine['engine'] === 'memcache') {
				if (!class_exists("Memcache")) {
					throw new CazuelaException("Memcache class not found. Please verify your PHP instalation", 2001);
				}
				
				$this->conn = new Memcache();
				$this->conn->connect($this->cacheEngine['host'], $this->cacheEngine['port']);
				self::$instance = $this;
			} else {
				throw new CazuelaException("Unsupported cache engine \"".$this->cacheEngine['engine']."\"");
			}
		} else {
			return self::$instance;
		}
	}
	
	/**
	 * Gets the CazuelaCache instance
	 * @throws CazuelaException
	 * @return CazuelaCache
	 */
	public static function getInstance() {
		if (Configure::read('cacheEnabled') == false) {
			throw new CazuelaException("Cache engine disabled by app configuration");
		}
		return self::$instance;
	}
	
	/**
	 * Reads from cache engine
	 * @param string $hash
	 * @throws CazuelaException
	 * @return mixed
	 */
	public static function read($hash) {
		if (Configure::read('cacheEnabled') == false) {
			throw new CazuelaException("Cache engine disabled by app configuration");
		}
		
		if (self::getInstance()->cacheEngine['engine'] === 'memcache') {
			return self::getInstance()->conn->get($hash);
		}
		
		return "";
	}
	
	/**
	 * Write to cache engine
	 * @param string $hash
	 * @param mixed $value
	 * @throws CazuelaException
	 */
	public static function write($hash, $value) {
		if (Configure::read('cacheEnabled') == false) {
			throw new CazuelaException("Cache engine disabled by app configuration");
		}
		
		if (self::getInstance()->cacheEngine['engine'] === 'memcache') {
			self::getInstance()->conn->add($hash, $value, MEMCACHE_COMPRESSED, self::getInstance()->cacheEngine['duration']);
		}
	}
}

?>