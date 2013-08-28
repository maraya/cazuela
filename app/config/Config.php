<?php

/** 
 * Application configuration
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
	
/**
 * Sets the datasources for the application
 * @var array
 */

$dataSources = array(
	'default' => array(
		'dbdriver' => 'oracle',
		'dbhost'   => '192.168.10.110',
		'dbport'   => '1521',
		'dbuser'   => 'maraya',
		'dbpass'   => 'maraya',
		'dbname'   => 'test',
		'dbopts'   => array()
	),
	'test' => array(
		'dbdriver' => 'mysql',
		'dbhost'   => 'localhost',
		'dbport'   => '',
		'dbuser'   => 'root',
		'dbpass'   => 'root',
		'dbname'   => 'mysql',
		'dbopts'   => array()
	)
);

/**
 * Cache enabled/disabled
 * @var array
 */
$cacheEnabled = false;
 
/**
 * Cache settings
 * @var array
 *
 *  APC (http://pecl.php.net/package/APC)
 *
 *		$cacheEngine = array(
 *			'engine'   => 'apc',
 *			'duration' => 3600,
 *			'prefix'   => CAZUELA_APP . '_' //[optional]
 *		);
 *	
 *  Memcached (http://www.danga.com/memcache/)
 *
 *		$cacheEngine = array(
 *			'engine'   => 'memcache',
 *			'host'     => 'localhost',
 *			'port' 	   => 11211,
 *			'duration' => 3600,
 *			'prefix'   => CAZUELA_APP . '_' //[optional]
 *		);
 */ 

$cacheEngine = array(
	'engine'   => 'apc',
	'duration' => 3600,
	'prefix'   => CAZUELA_APP . '_'
);

/**
 * Sets the debug level
 *  @var integer
 */
$debug = 1;

/**
 * Sets the encoding
 * @var string
 */
$encoding = 'UTF-8';

?>