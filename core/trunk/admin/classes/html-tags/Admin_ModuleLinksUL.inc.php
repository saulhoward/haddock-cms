<?php
/**
 * Admin_ModuleLinksUL
 *
 * @copyright 2007-01-08, RFI
 */

#/**
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ProjectDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/'
#	. 'HTMLTags_URL.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_UL.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_LI.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_A.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_Span.inc.php';

/**
 * A UL for listing the modules that have admin sections.
 */
class
	Admin_ModuleLinksUL
extends
	HTMLTags_UL
{
	public function
		__construct(
			HaddockProjectOrganisation_ProjectDirectory $project_directory
		)
	{
		parent::__construct();
		
		$m_w_a_ss = $project_directory->get_modules_with_admin_sections();
		
		foreach ($m_w_a_ss as $m_w_a_s) {
			$module_li = new HTMLTags_LI();
			
			$module_a = new HTMLTags_A();
			
			//$module_href = new HTMLTags_URL();
			
			#if (
			#    is_a(
			#        $m_w_a_s,
			#        'HaddockProjectOrganisation_ProjectSpecificDirectory'
			#    )
			#) {
			#    $module_name = 'project-specific';
			#} else {
			#    $module_name_l_o_ws = $m_w_a_s->get_module_name_as_l_o_w();
			#    $module_name = $module_name_l_o_ws->get_words_as_delimited_lc_string('-');
			#}
			//$module_name = $m_w_a_s->get_admin_section_directory_name();
			//
			//#$module_href->set_file('/admin/' . $module_name . '/home.html');
			//$module_href->set_file('/admin/hc/' . $module_name . '/home.html');
			
			$module_href = $m_w_a_s->get_admin_section_home_page_href();
			
			$module_a->set_href($module_href);
			
			$module_config_file = $m_w_a_s->get_module_config_file();
			
			$module_span = new HTMLTags_Span(
				$module_config_file->get_admin_section_title()
			);
			
			$module_a->append_tag_to_content($module_span);
			
			$module_li->append_tag_to_content($module_a);
			
			$this->add_li($module_li);
		}
	}
}
?>