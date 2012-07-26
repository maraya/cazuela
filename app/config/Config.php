<?php
	
	$dbinfo = array('dbdriver' => 'pdo-pgsql'
				   ,'dbhost'   => 'localhost'
				   ,'dbport'   => ''
				   ,'dbuser'   => 'maraya'
				   ,'dbpass'   => 'maraya'
				   ,'dbname'   => 'lapintana_devel'
				   ,'dbschm'   => ''
				   ,'dbopts'   => array());
	
	Configure::write('dbinfo', $dbinfo);
	Configure::write('encoding', 'UTF-8');
	
	//sets the debug level
	// 0: none
	// 1 debug
	Configure::write('debug', 1);
	
?>
