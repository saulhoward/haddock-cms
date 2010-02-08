<?php
/**
 * PublicHTML_HTTPResponse
 *
 * @copyright Clear Line Web Design, 2007-11-16
 */

/**
 * A partial implemention of a response to a HTTP/1.1
 *
 * We need to implement only a subset of the whole response.
 * 
 * See http://www.w3.org/Protocols/rfc2616/rfc2616.html
 */
abstract class
	PublicHTML_HTTPResponse
{
	abstract public function
		get_entity_header();
	
	abstract public function
		get_entity_body();
}
?>