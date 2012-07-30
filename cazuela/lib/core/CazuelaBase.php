<?php

/** 
 * Class to manage the database requests
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */

class CazuelaBase {
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
	 * CazuelaBase Construct
	 */
	public function __construct() {
		if ($this->useDBConn == true) {
			$dataSources = Configure::read('dataSources');
			
			if (array_key_exists($this->dataSource, $dataSources) === false) {
				throw new CazuelaException("Unknown datasource ". $this->dataSource);
			}
			
			$this->db = new CazuelaDB($dataSources[$this->dataSource]);	
		}
	}
	
	/**
	 * Method to query a SQL statement, returns an array object that contains the data
	 * Use only for SELECT statements
	 * @param string $sql
	 * @throws CazuelaException
	 * @return array
	 */
	protected function query($sql) {
		if ($this->useDBConn == false) {
			throw new CazuelaException("DBConn set to false", 500);
		}
		
		if (Configure::read('debug') == 1) {
			CazuelaDebug::append("query", $sql);
		}
		
		$res = $this->db->query($sql);
		return $res;
	}
	
	/**
	 * Method to query a SQL statement, returns true on success or false on failure
	 * Use only for INSERT, UPDATE, DELETE statements
	 * @param string $sql
	 * @throws CazuelaException
	 * @return array
	 */
	protected function execute($sql) {
		if ($this->useDBConn == false) {
			throw new CazuelaException("DBConn set to false", 500);
		}
		
		if (Configure::read('debug') == 1) {
			CazuelaDebug::append("query", $sql);
		}
		
		$res = $this->db->query($sql);
		return $res;
	}
}

?>