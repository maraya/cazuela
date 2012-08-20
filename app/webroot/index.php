<?php

/** 
 * Application index
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Cazuela. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * If Cazuela is in a different path, please change the CAZUELA_BASE constant
 */
if (!defined('CAZUELA_BASE')) {
	define('CAZUELA_BASE', dirname(dirname(dirname(__FILE__))) . '/cazuela');
}

/**
 * Cazuela app root, do not change
 */
if (!defined('CAZUELA_APP_ROOT')) {
	define('CAZUELA_APP_ROOT', dirname(dirname(__FILE__))); 
}

require(CAZUELA_APP_ROOT . "/config/Config.php");
require(CAZUELA_BASE . "/lib/core/Bootstrap.php");	

if (Configure::read('debug') === 1) {
	error_reporting(E_ALL | E_STRICT);
} else {
	error_reporting(0);
}
		
$dispatcher = new Dispatcher();
$request = new CazuelaRequest();
$response = new CazuelaResponse(array('charset' => Configure::read('encoding')));
$dispatcher->dispatch($request, $response);

ob_clean();
header("Content-Type: ".$response->getContentType());
echo $response->getOutput();
	
?>
