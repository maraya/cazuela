<?php
	
/**
 * Bootstrap: File to manage all requires/includes
 * @author maraya
 *
 * Version: 0.1 (26 July 2012)
 */

require(CAZUELA_BASE . "/lib/core/Configure.php");
require(CAZUELA_BASE . "/lib/core/CazuelaDB.php");
require(CAZUELA_BASE . "/lib/core/CazuelaBase.php");
require(CAZUELA_BASE . "/lib/core/AppBase.php");
require(CAZUELA_BASE . "/lib/core/CazuelaException.php");	
require(CAZUELA_BASE . "/lib/core/Dispatcher.php");
require(CAZUELA_BASE . "/lib/core/CazuelaRequest.php");
require(CAZUELA_BASE . "/lib/core/JSON.php");
require(CAZUELA_BASE . "/lib/contrib/Array2XML.php");
require(CAZUELA_BASE . "/lib/core/XML.php");
require(CAZUELA_BASE . "/lib/core/YAML.php");
require(CAZUELA_BASE . "/lib/core/CazuelaResponse.php");
require(CAZUELA_BASE . "/lib/core/CazuelaDebug.php");	

/**
 * Write configuration vars
 */
Configure::write('dataSources', $dataSources);
Configure::write('encoding', $encoding);
Configure::write('debug', $debug);	
	
?>