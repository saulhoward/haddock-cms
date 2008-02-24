<?php
abstract class
	PublicHTML_PCROFactory
{
	abstract public function
		get_page_class_reflection_object_name();
		
	public function
		get_page_class_reflection_object()
	{
		$pcrc = new ReflectionClass($this->get_page_class_reflection_object_name());
		$pcro = $pcrc->newInstance();
		
		return $pcro;
	}
}
?>