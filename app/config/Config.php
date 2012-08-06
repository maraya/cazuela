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
 * Sets the datasources for the applicaction
 * @var array
 */

$dataSources = array(
	'default' => array(
		'dbdriver' => 'pgsql',
		'dbhost'   => 'localhost',
		'dbport'   => '',
		'dbuser'   => 'maraya',
		'dbpass'   => 'maraya',
		'dbname'   => 'fungibles_devel',
		'dbschm'   => '',
		'dbopts'   => array()
	),
	'test' => array(
		'dbdriver' => 'mysql',
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

?>
