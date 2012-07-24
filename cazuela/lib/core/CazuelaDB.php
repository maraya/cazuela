<?php
class CazuelaDB extends PDO {
	private $dsn;
			
	public function __construct($dbinfo) {
		$port = null;
		$schm = null;
				
		if ($dbinfo['dbdriver'] == "pdo-mysql") {
			$driver = "mysql";
		} else if ($dbinfo['dbdriver'] == "pdo-pgsql") {
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

	public function execute($sql) {
		$stmt = $this->prepare($sql);
		$exec = $stmt->execute();
		
		if (!$exec) {
			$err = $this->errorInfo();
			throw new CazuelaException($err[2], 400);
		}
		return $exec;
	}
}
		
?>