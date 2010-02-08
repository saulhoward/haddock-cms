<?php
/**
 * HaddockProjectOrganisation_FullHaddockClassNameValidator
 *
 * @copyright 2010-02-08, Robert Impey
 */

class
	HaddockProjectOrganisation_FullHaddockClassNameValidator
extends
	InputValidation_RegexValidator
{
	protected function
		get_regex()
	{
		/*
		 * Write the regex here.
		 */
		return '/^(:?[A-Z][A-Za-z0-9]*)+_(:?[A-Z][A-Za-z0-9]*)+$/';
	}
	
	protected function
		get_exception_message()
	{
		/*
		 * Write a more informative exception message here.
		 */
		return 'Full Haddock class names must be like FooBar_BishBashBosh!';
	}
}
?>