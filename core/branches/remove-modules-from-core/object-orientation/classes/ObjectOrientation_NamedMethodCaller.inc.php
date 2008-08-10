<?php
/**
 * ObjectOrientation_NamedMethodCaller
 *
 * @copyright RFI 2007-12-18
 */

class
	ObjectOrientation_NamedMethodCaller
{
	/**
	 * Given an object and the name of a method,
	 * the named method is called.
	 *
	 * A simple wrapper around some reflection class code.
	 */
	public static function
		call_method_by_name($object, $method_name)
	{
		$cn = get_class($object);
		
		$rc = new ReflectionClass($cn);
		
		$crm = $rc->getMethod($method_name);
		
		return $crm->invoke($object);
	}
}
?>