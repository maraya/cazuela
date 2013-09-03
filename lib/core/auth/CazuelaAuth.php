<?php

/** 
 * Class to manage authenticated service requests
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

class CazuelaAuth {
	/**
	 * Holds the realm type
	 * @var string
	 */
	private $type;
	
	/**
	 * Holds the realm title
	 * @var string
	 */
	private $realm;
	
	/**
	 * Holds the username
	 * @var string
	 */
	private $username;
	
	/**
	 * Holds the password
	 * @var string
	 */
	private $password;
	
	/**
	 * Holds the authorized flag
	 * @var boolean
	 */
	private $authorized = false;
	
	/**
	 * Holds the CazuelaAuth instance
	 * @var CazuelaAuth
	 */
	private static $instance = null;
	
	/**
	 * CazuelaAuth Construct
	 */
	public function __construct($authData) {
		if (self::$instance == null) {
			if ($authData['type'] == 'basic') {
				$this->type = $authData['type'];
				$this->realm = $authData['realm'];
				$this->username = $authData['username'];
				$this->password = $authData['password'];
			} else {
				throw new CazuelaException("Unknown auth type \"".$authData['type']."\"", 3001);
			}
			self::$instance = $this;
		} else {
			return $instance;	
		}
	}
	
	/**
	 * Returns CazuelaAuth instance
	 * @return CazuelaAuth
	 */
	public static function getInstance() {
		return self::$instance;	
	}
	
	/**
	 * Returns if the service was successfully authenticated or not 
	 * @return boolean
	 */
	public function isAuthorized() {
		return $this->authorized;	
	}
	
	/**
	 * Auth headers 
	 * @return void
	 */
	private function authHeaders() {
		header('WWW-Authenticate: Basic realm = '.$this->realm);
		header('HTTP/1.0 401 Unauthorized');	
	}
	
	/**
	 * Auths the response
	 * @return void
	 */
	public function auth() {
		if ($this->type == 'basic') {
			if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
				$this->authHeaders();
				$this->authorized = false;
			} else {
				
				if ($_SERVER['PHP_AUTH_USER'] != $this->username && $_SERVER['PHP_AUTH_PW'] != $this->password) {
					$this->authHeaders();
					$this->authorized = false;
				} else {
					$this->authorized = true;	
				}
			}
		}		
	}
}
