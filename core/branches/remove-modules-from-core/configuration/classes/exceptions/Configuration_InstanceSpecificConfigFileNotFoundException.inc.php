<?php
/**
 * Configuration_InstanceSpecificConfigFileNotFoundException
 *
 * @copyright 2008-05-30, RFI
 */

class
	Configuration_InstanceSpecificConfigFileNotFoundException
extends
	Configuration_ConfigFileNotFoundException
{
	public function
		__construct(
			$module_name,
			$file_name
		)
	{
		parent
			::__construct(
				$file_name,
				$module_name,
				'instance specific'
			);
	}
}
?>