<?php
/**
 * Admin_PageDirectory
 *
 * @copyright 2007-01-24, RFI
 */

#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_PageDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/'
#    . 'HTMLTags_URL.inc.php';

class
	Admin_PageDirectory
extends
	HaddockProjectOrganisation_PageDirectory
{
	private $debug = FALSE;
	#private $debug = TRUE;
	
	/**
	 * Returns the URL of the page.
	 *
	 * TO DO:
	 *
	 * Use the URL class?
	 */
	public function
		get_html_tags_href()
	{
		$url = '';

		/*
		 * Find the module that this link is in.
		 */
		$includes_directory = $this->get_includes_directory();
		
		$module = $includes_directory->get_module_directory();
		
		/*
		 * All these links are in the admin section.
		 */
		$url .= '/admin/';
		
		$url .= $module->get_section_short_form();
		
		$url .= '/';
		
		$url .= $module->get_admin_section_directory_name();
		
		$url .= '/';
		
		/*
		 * Which page are we showing?
		 */
		$url .= $this->get_page_name();
		
		/*
		 * The links look like HTML files.
		 */
		$url .= '.html';
		
		return new HTMLTags_URL($url);
	}
	
	private function
		get_inc_filename($element)
	{
		return $this->get_name() . "/$element.inc.php";
	}
	
	public function
		has_inc_file($element)
	{
		return is_file($this->get_inc_filename($element));
	}
	
	public function
		render_inc_file($element)
	{
		$inc_file = $this->get_inc_filename($element);
		
		#echo "\$inc_file: $inc_file\n";
		
		if ($this->debug) {
			echo "\nAbout to require \"$inc_file\"\n\n";
		}
		
		require $inc_file;
		
		if ($this->debug) {
			echo "\nJust required \"$inc_file\"\n\n";
		}
	}
	
	public function
		create_inc_files($copyright_holder)
	{
		$pre_html_inc_filename = $this->get_name() . '/pre-html.inc.php';
		
		if (file_exists($pre_html_inc_filename)) {
			#echo "$pre_html_inc_filename already exists!\n";
		} else {
			$pre_html_inc_file
				= new HaddockProjectOrganisation_PHPIncFile($pre_html_inc_filename);
			
			$pre_html_inc_file
				->set_title_line(
					'Pre-html code for the "'
					. $this->get_page_name()
					. '" admin page.'
				);
			
			$pre_html_inc_file->set_copyright_holder($copyright_holder);
			
			$pre_html_inc_file->save();
		}
		
		$body_div_content_inc_filename
			= $this->get_name() . '/body.div.content.inc.php';
		
		if (file_exists($body_div_content_inc_filename)) {
			#echo "$body_div_content_inc_filename already exists!\n";
		} else {
			$body_div_content_inc_file
				= new HaddockProjectOrganisation_PHPIncFile(
					$body_div_content_inc_filename
				);
			
			$body_div_content_inc_file
				->set_title_line(
					'Content of the "'
					. $this->get_page_name()
					. '" admin page.');
			
			$body_div_content_inc_file->set_copyright_holder($copyright_holder);
			
			$content_div_content = '';
			
			$content_div_content .= '$content_div = new HTMLTags_Div();' . "\n";
			$content_div_content .= '$content_div->set_attribute_str(\'id\', \'content\');' . "\n";
			
			$content_div_content .= "\n";

			$content_div_content .= 'echo $content_div->get_as_string();' . "\n";
			
			$body_div_content_inc_file->set_body($content_div_content);
			
			$body_div_content_inc_file->save();
		}
		
		$redirect_script_inc_filename
			= $this->get_name() . '/redirect-script.inc.php';
		
		if (file_exists($redirect_script_inc_filename)) {
			#echo "$redirect_script_inc_filename already exists!\n";
		} else {
			$redirect_script_inc_file
				= new HaddockProjectOrganisation_PHPIncFile(
					$redirect_script_inc_filename
				);
			
			$redirect_script_inc_file
				->set_title_line(
					'Redirect script for the "'
					. $this->get_page_name() . '" admin page.'
				);
			
			$redirect_script_inc_file->set_copyright_holder($copyright_holder);
			
			$redirect_script_inc_file->save();
		}
	}
}
?>