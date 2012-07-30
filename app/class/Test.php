<?php

class Test extends AppBase {
	public $useDBConn = true;
	//public $dataSource = 'default';

	public function getTest($action, $test = null) {
	
		//print_r ($action);
		//print_r ($action2);
	
		//$res = $this->query("select now() as now");
		//return array('message' => 'Hello World!', 'now' => $res[0]['now']);

		//return array('message' => 'Hello World!');
		
		return "Hello World!";
	}
}

?>