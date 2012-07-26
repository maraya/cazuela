<?php

class CazuelaBase {
	private static $instance;
	private $db;
	public $useDBConn = true;

	public function __construct() {
		if ($this->useDBConn == true) {
			$this->db = new CazuelaDB(Configure::read('dbinfo'));	
		}
		self::$instance = $this;
	}

	protected static function getInstance() {
		return self::$instance;
	}
	
	protected function query ($sql) {
		if ($this->useDBConn == false) {
			throw new CazuelaException("DBConn set to false", 500);
		}
		
		if (Configure::read('debug') == 1) {
			CazuelaDebug::append("query", $sql);
		}
		
		$res = $this->db->query($sql);
		return $res;
	}
	
	protected function execute($sql) {
		if ($this->useDBConn == false) {
			throw new CazuelaException("DBConn set to false", 500);
		}
		
		$res = $this->db->query($sql);
		return $res;
	}
}

?>