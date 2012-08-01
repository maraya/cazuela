<?php

class Test extends AppBase {
	public $useDBConn = true;
	public $dataSource = 'default';

	public function getTest($action, $test = null) {
	
		$res1 = $this->query("select now() as now");
	
		$this->setDataSource('test');
		
		$res2 = $this->query("select now() as now");
		return array('message' => 'Hello World!', 'now-mysql' => $res1[0]['now'], "now-postgres" => $res2[0]['now']);
	}
}

?>