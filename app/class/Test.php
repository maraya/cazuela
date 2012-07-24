<?php

class Test extends AppBase {

	public function getTest() {
		$res = $this->query("select now() as now");
		return array('message' => 'Hello World!', 'now' => $res[0]['now']);	
	}
}

?>