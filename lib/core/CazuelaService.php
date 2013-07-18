<?php

/** 
 * Class to manage the database requests
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

class CazuelaService {
	/**
	 * Holds the CazuelaDB instance
	 * @var CazuelaDB
	 */
	protected $db;
	
	/**
	 * Flag to define if the class uses a database connection
	 * @var boolean
	 */
	public $useDBConn = true;
	
	/**
	 * Name of the datasource, by default "default"
	 * @var string
	 */
	public $dataSource = 'default';
	
	/**
	 * Holds the array of datasources
	 * @var array
	 */
	public $dataSources = array();
	
	/**
	 * CazuelaCache instance
	 * @var CazuelaCache
	 */
	public $cache = array();

	/**
	 * CazuelaBase Construct
	 */
	public function __construct() {
		if ($this->useDBConn == true) {
			$this->dataSources = Configure::read('dataSources');
			
			if (array_key_exists($this->dataSource, $this->dataSources) === false) {
				throw new CazuelaException("Unknown datasource ". $this->dataSource, 1000);
			}
			
			$this->db = new CazuelaDB($this->dataSources[$this->dataSource]);
		}
		
		if (Configure::read('cacheEnabled') == true) {
			$this->cache = new CazuelaCache();
		}
	}
	
	/**
	 * Method to query a SQL statement, returns an array object that contains the data
	 * Use only for SELECT statements
	 * @param string $sql
	 * @params array $params
	 * @throws CazuelaException
	 * @return array
	 */
	protected function query($sql, $params = array()) {
		if ($this->useDBConn == false) {
			throw new CazuelaException("useDBConn set to false", 1001);
		}
		
		// cache
		$time_start = microtime(true);
		
		if (Configure::read('cacheEnabled') == true) {
			$hash = sha1($this->dataSource . $sql);
			$cacheRes = CazuelaCache::read($hash);
			
			if (!empty($cacheRes)) {
				$res = $cacheRes;
				$time_end = microtime(true);
			} else {
				$res = $this->db->query($sql, $params);
				CazuelaCache::write($hash, $res);
				$time_end = microtime(true);
			}
		} else {
			$res = $this->db->query($sql, $params);
			$time_end = microtime(true);
		}
		
		$access = (!empty($cacheRes))? 'cache': 'sql';
		$time = $time_end - $time_start;
		
		if (Configure::read('debug') == 1) {
			$info = array();
			
			if ($this->useDBConn == true) {
				$info['datasource'] = $this->dataSource;
			}
			
			$info['statement'] = $sql;
			$info['access'] = $access;
			$info['time'] = $time;
			CazuelaDebug::append("query", $info);
		}
		
		return $res;
	}
	
	/**
	 * Method to query a SQL statement, returns true on success or false on failure
	 * Use only for INSERT, UPDATE, DELETE statements
	 * @param string $sql
	 * @params array @params
	 * @throws CazuelaException
	 * @return array
	 */
	protected function execute($sql, $params = array()) {
		if ($this->useDBConn == false) {
			throw new CazuelaException("useDBConn set to false", 1001);
		}
		
		$time_start = microtime(true);
		$res = $this->db->query($sql, $params);
		$time_end = microtime(true);
		$time = $time_end - $time_start;
		
		if (Configure::read('debug') == 1) {
			$info = array();
			
			if ($this->useDBConn == true) {
				$info['datasource'] = $this->dataSource;
			}
			
			$info['statement'] = $sql;
			$info['time'] = $time;
			CazuelaDebug::append("query", $info);
		}
		
		return $res;
	}
	
	/**
	 * Sets the datasource
	 * @param string $dataSource
	 * @throws CazuelaException
	 */
	protected function setDataSource($dataSource) {
		if (array_key_exists($dataSource, $this->dataSources) === false) {
			throw new CazuelaException("Unknown datasource ". $dataSource, 1000);
		}
		
		$this->dataSource = $dataSource;
		$this->db = new CazuelaDB($this->dataSources[$this->dataSource]);	
	}
	
	/**
	 * beforeCall method (for overriding)
	 */
	public function beforeCall() {
	}
	
	/**
	 * afterCall method (for overriding)
	 */
	public function afterCall() {
	}
}

?>