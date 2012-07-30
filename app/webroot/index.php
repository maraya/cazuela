<?php

/** 
 * Application index
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */

error_reporting(E_ALL | E_STRICT);

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
		
$dispatcher = new Dispatcher();
$request = new CazuelaRequest();
$response = new CazuelaResponse(array('charset' => Configure::read('encoding')));
$dispatcher->dispatch($request, $response);

header("Content-Type: ".$response->getContentType());
echo $response->getOutput();
	
?>
