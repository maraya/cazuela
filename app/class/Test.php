<?php

/**
 * Test class
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