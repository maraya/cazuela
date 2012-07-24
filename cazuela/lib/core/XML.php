<?php

class XML {

	public static function get($output, $charset) {
		Array2XML::init('1.0', $charset);
		$xml = Array2XML::createXML('root', $output);
		
		return $xml->saveXML();
	}
}
?>