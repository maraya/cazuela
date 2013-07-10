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
		'dbdriver' => 'mysql',
		'dbhost'   => '192.168.10.19',
		'dbport'   => '',
		'dbuser'   => 'framework',
		'dbpass'   => 'Tv4L4sEmZQce7Ww2',
		'dbname'   => 'eclass_33',
		'dbschm'   => '',
		'dbopts'   => array()
	),
	'test' => array(
		'dbdriver' => 'mysql',
		'dbhost'   => 'localhost',
		'dbport'   => '',
		'dbuser'   => 'root',
		'dbpass'   => 'root',
		'dbname'   => 'mysql',
		'dbschm'   => '',
		'dbopts'   => array()
	)
);

/**
 * Cache enabled/disabled
 * @var array
 */
$cache = true;
 
/**
 * Cache enabled/disabled
 * @var array
 */ 
 
$time = 1800;

$engine = array(
	'host' => 'localhost',
	'port' => 11211
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
