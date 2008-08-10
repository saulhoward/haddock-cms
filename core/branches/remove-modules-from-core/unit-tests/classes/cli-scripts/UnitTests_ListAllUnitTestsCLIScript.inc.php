<?php
/**
 * UnitTests_ListAllUnitTestsCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	UnitTests_ListAllUnitTestsCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		UnitTests_TestsHelper::list_all_unit_tests();
	}
}
?>