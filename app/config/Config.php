<?php

/** 
 * Application configuration
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */
	
/**
 * Sets the datasources for the applicaction
 * @var array
 */

$dataSources = array(
	'default' => array(
		'dbdriver' => 'pdo-pgsql',
		'dbhost'   => 'localhost',
		'dbport'   => '',
		'dbuser'   => 'maraya',
		'dbpass'   => 'maraya',
		'dbname'   => 'fungibles_devel',
		'dbschm'   => '',
		'dbopts'   => array()
	),
	'test' => array(
		'dbdriver' => 'pdo-mysql',
		'dbhost'   => 'localhost',
		'dbport'   => '',
		'dbuser'   => 'root',
		'dbpass'   => '321321',
		'dbname'   => 'mysql',
		'dbschm'   => '',
		'dbopts'   => array()
	)
);

/**
 * Sets the debug level
 *  @var integer
 */
$debug = 1;

/**
 * Sets ethe encoding
 * @var string
 */
$encoding = 'UTF-8';

	/*
	//$dbinfo = 
	Configure::write('dbinfo', $dbinfo);
	Configure::write('encoding', 'UTF-8');
	
	//sets the debug level
	// 0: none
	// 1 debug
	Configure::write('debug', 1);
	*/
?>
