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
				
			} elseif ($this->cacheEngine['engine'] === 'apc') {
				if (!function_exists("apc_add")) {
					throw new CazuelaException("APC extension not found. Please verify your PHP instalation", 2001);
				}				
			} else {
				throw new CazuelaException("Unsupported cache engine \"".$this->cacheEngine['engine']."\"", 3000);
			}
			
			self::$instance = $this;
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
		
		if (isset(self::getInstance()->cacheEngine['prefix'])) {
			$hash = self::getInstance()->cacheEngine['prefix'] . $hash;
		}
		
		$engine = self::getInstance()->cacheEngine['engine'];
		
		if ($engine === 'memcache') {
			return self::getInstance()->conn->get($hash);
		} elseif ($engine === 'apc') {
			return apc_fetch($hash);
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
		
		if (isset(self::getInstance()->cacheEngine['prefix'])) {
			$hash = self::getInstance()->cacheEngine['prefix'] . $hash;
		}
		
		$engine = self::getInstance()->cacheEngine['engine'];
		$duration = self::getInstance()->cacheEngine['duration'];
		
		if ($engine === 'memcache') {
			self::getInstance()->conn->add($hash, $value, MEMCACHE_COMPRESSED, $duration);
		} elseif ($engine === 'apc') {
			apc_add($hash, $value, $duration);
		}
	}
	
	/**
	 * Delete key from cache engine
	 * @param string $hash
	 * @throws CazuelaException
	 */
	public static function delete($hash) {
		if (Configure::read('cacheEnabled') == false) {
			throw new CazuelaException("Cache engine disabled by app configuration");
		}
		
		if (isset(self::getInstance()->cacheEngine['prefix'])) {
			$hash = self::getInstance()->cacheEngine['prefix'] . $hash;
		}
		
		if ($engine === 'memcache') {
			self::getInstance()->conn->delete($hash);
		} elseif ($engine === 'apc') {
			apc_delete($hash);
		}
	}
}

?>