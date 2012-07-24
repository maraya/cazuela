<?php

class CazuelaBase {
	private static $instance;
	private $db;

	public function __construct() {
		$this->db = new CazuelaDB(Configure::read('dbinfo'));
		self::$instance = $this;
	}

	public static function getInstance() {
		return $instance;
	}
	
	public function query ($sql) {
		if (Configure::read('debug') == 1) {
			CazuelaDebug::append("query", $sql);
		}
		
		$res = $this->db->query($sql);
		return $res;
	}
	
	public function execute($sql) {
		$res = $this->db->query($sql);
		return $res;
	}
}

?>