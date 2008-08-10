<?php
/**
 * PublicHTML_PCROFactory
 *
 * @copyright 2008-02-09 RFI
 */

/**
 * The Page Class Reflection Object Factory.
 *
 * Sub-classes of this class create objects that can be used
 * to build pages.
 */
abstract class
	PublicHTML_PCROFactory
{
	abstract public function
		get_page_class_reflection_object_name();
		
	public function
		get_page_class_reflection_object()
	{
		$pcrc
			= new ReflectionClass(
				$this->get_page_class_reflection_object_name()
			);
		
		$pcro = $pcrc->newInstance();
		
		return $pcro;
	}
}
?>