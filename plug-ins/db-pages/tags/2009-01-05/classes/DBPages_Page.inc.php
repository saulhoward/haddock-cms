<?php
/**
 * DBPages_Page
 *
 * @copyright RFI 2007-12-15
 */

/**
 * Holds the data for a page in the db page module.
 */
class
	DBPages_Page
{
	private $name;
	
	private $sections;
	
	public function
		__construct($name)
	{
		$this->name = $name;
		
		$this->sections = array();
	}
	
	public function
		add_section(
			$section_name,
			DBPages_Section $section
		)
	{
		$this->sections[$section_name] = $section;
	}
	
	public function
		get_section($section_name)
	{
		if (isset($this->sections[$section_name])) {
			return $this->sections[$section_name];
		} else {
			throw new Exception("No section called '$section_name' on the '$this->name' page!");
		}
	}
}
?>