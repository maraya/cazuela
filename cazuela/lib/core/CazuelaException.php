<?php

/** 
 * CazuelaException class, extends Exception
 * @author maraya
 * Version: 0.1 (26 July 2012)
 */

class CazuelaException extends Exception {
	
	/**
	 * CazuelaException Construct
	 * @param string $message
	 * @param int $code
	 */
	public function __construct($message = "", $code = 0) {
		parent::__construct($message, $code);
	}
}

?>
