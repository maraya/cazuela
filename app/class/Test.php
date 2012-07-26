<?php

class Test extends AppBase {
	public $useDBConn = false;

	public function getTest($action, $action2) {
	
		//print_r ($action);
		//print_r ($action2);
	
		$res = $this->query("select now() as now");
		//return array('message' => 'Hello World!', 'now' => $res[0]['now']);

		return array('message' => 'Hello World!');
	}
}

?>