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

class TestService extends ServiceBase {
	public $useDBConn = true;
	//public $dataSource = 'default';
	public $auth = array(
		'type' => 'basic',
		'realm' => 'Private Area',
		'username' => 'test',
		'password' => 'test'
	);

	public function getTest() {
		if ($this->request->is('get')) {
			$res = $this->query("select now() as now");
			return array('message' => 'Hello World!', 'time' => $res[0]['now']);
		} else {
			return 'Forbidden request method!';
		}
	}
}

?>