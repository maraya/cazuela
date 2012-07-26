<?php

	error_reporting(E_ALL | E_STRICT);
	
	if (!defined('CAZUELA_BASE')) {
		define('CAZUELA_BASE', '../../cazuela');
	}
	
	if (!defined('CAZUELA_APP_ROOT')) {
		define('CAZUELA_APP_ROOT', '/var/www/cazuela/app');
	}

	require(CAZUELA_BASE . "/lib/core/Bootstrap.php");	
		
	$dispatcher = new Dispatcher();
	$dispatcher->dispatch(
		new CazuelaRequest(),
		new CazuelaResponse(array('charset' => Configure::read('encoding')))
	);
	
?>
