<?php

	error_reporting(E_ALL | E_STRICT);
	
	if (!defined('CAZUELA_BASE')) {
		define('CAZUELA_BASE', '../../cazuela');
	}
	
	if (!defined('CAZUELA_APP_ROOT')) {
		define('CAZUELA_APP_ROOT', '../../app');
	}

	require(CAZUELA_BASE . "/lib/core/Bootstrap.php");	
		
	$dispatcher = new Dispatcher();
	$request = new CazuelaRequest();
	$response = new CazuelaResponse(array('charset' => Configure::read('encoding')));
	$dispatcher->dispatch($request, $response);
	
	header("Content-Type: ".$response->getContentType());
	echo $response->getOutput();
	
?>
