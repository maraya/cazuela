<?php

/**
 * Test class
 * @author maraya
 */

class Test extends AppBase {
	public $useDBConn = true;
	//public $dataSource = 'default';

	public function getTest() {
	
		$res1 = $this->query("select now() as now");
	
		$this->setDataSource('test');
		
		$res2 = $this->query("select now() as now");
		return array('message' => 'Hello World!', 'now-postgres' => $res1[0]['now'], "now-mysql" => $res2[0]['now']);
	}
}

?>