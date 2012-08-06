<?php

/** 
 * Database Layer, extends PDO
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

class CazuelaDB extends PDO {
	/**
	 * Holds the data source name string
	 * @var string
	 */
	private $dsn;
	
	/**
	 * CazuelaDB Constructor
	 * @param array $dbinfo - Holds the database configuration
	 * @throws CazuelaException
	 */
	public function __construct($dbinfo) {
		$port = null;
		$schm = null;
				
		if ($dbinfo['dbdriver'] == "mysql") {
			$driver = "mysql";
		} else if ($dbinfo['dbdriver'] == "pgsql") {
			$driver = "pgsql";
		} else {
			throw new CazuelaException($dbinfo['dbdriver']." database driver doesn't exist", 500);
		}
		
		if (trim($dbinfo['dbport']) != "") {
			$port = ";port=".$dbinfo['dbport'];
		} 
		
		if (trim($dbinfo['dbschm']) != "") {
			$schm = "";
		} 
				
		if (!is_array($dbinfo['dbopts'])) {
			$dbinfo['dbopts'] = array();
		}
				
		$this->dsn = $driver.":dbname=".$dbinfo['dbname'].";host=".$dbinfo['dbhost'].$port;
				
		try {
			parent::__construct($this->dsn, $dbinfo['dbuser'], $dbinfo['dbpass'], $dbinfo['dbopts']);
		} catch (PDOException $e) {
			throw new CazuelaException("PDO Error: ". $e->getMessage(), 500);
		}
	}
	
	/**
	 * Method to query a SQL statement, returns an array object that contains the data
	 * Use only for SELECT statements
	 * @param string $sql
	 * @throws CazuelaException
	 * @return array
	 */
	public function query($sql) {
		$data = array();
		$stmt = $this->prepare($sql);
		$stmt->setFetchMode(parent::FETCH_ASSOC);
		
		if (!$stmt->execute()) {
			$err = $this->errorInfo();
			throw new CazuelaException($err[2], 400);
		}
		
		$data = $stmt->fetchAll();
		return $data;
	}

	/**
	 * Method to query a SQL statement, returns true on success or false on failure
	 * Use only for INSERT, UPDATE, DELETE statements
	 * @param string $sql
	 * @throws CazuelaException
	 * @return array
	 */
	public function execute($sql) {
		$stmt = $this->prepare($sql);
		$exec = $stmt->execute();
		
		if ($exec === false) {
			$err = $this->errorInfo();
			throw new CazuelaException($err[2], 400);
		}
		return $exec;
	}
}
		
?>