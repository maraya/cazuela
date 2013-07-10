<?php
	
/**
 * Bootstrap: File to manage all requires/includes
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

require(CAZUELA_BASE . "/core/Configure.php");
require(CAZUELA_BASE . "/core/CazuelaSanitize.php");
require(CAZUELA_BASE . "/core/CazuelaDB.php");
require(CAZUELA_BASE . "/core/CazuelaService.php");

if (file_exists(CAZUELA_APP_ROOT . "/services/ServiceBase.php")) {
	require(CAZUELA_APP_ROOT . "/services/ServiceBase.php");
} else {
	require(CAZUELA_BASE . "/core/ServiceBase.php");	
}

require(CAZUELA_BASE . "/core/CazuelaException.php");	
require(CAZUELA_BASE . "/core/Dispatcher.php");
require(CAZUELA_BASE . "/core/CazuelaRequest.php");
require(CAZUELA_BASE . "/core/JSON.php");
require(CAZUELA_BASE . "/core/XML.php");
require(CAZUELA_BASE . "/core/YAML.php");
require(CAZUELA_BASE . "/core/CazuelaResponse.php");
require(CAZUELA_BASE . "/core/CazuelaDebug.php");	

/**
 * Write configuration vars
 */
Configure::write('dataSources', $dataSources);
Configure::write('encoding', $encoding);
Configure::write('debug', $debug);	
	
?>