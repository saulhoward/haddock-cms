<?php
/**
 * Environment_MachineHelper
 *
 * @copyright 2008-05-08, RFI
 */

class
	Environment_MachineHelper
{
	public static function
		get_real_host_name()
	{
		return trim(`hostname --fqdn`);
	}
	
	public static function
		get_temporary_directory()
	{
		return new FileSystem_Directory('/tmp');
	}
}
?>