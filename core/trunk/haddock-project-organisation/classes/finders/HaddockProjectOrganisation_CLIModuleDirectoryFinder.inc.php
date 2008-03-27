<?php
/**
 * HaddockProjectOrganisation_CLIModuleDirectoryFinder
 *
 * @copyright Clear Line Web Design, 2007-07-31
 */

class
	HaddockProjectOrganisation_CLIModuleDirectoryFinder
{
    public static function
        find_section_and_module(
            $args,
            $section_arg_name,
            $section_question,
            $module_arg_name,
            $module_question
        )
    {
        $section_and_module = array();
        
        if (isset($args[$section_arg_name])) {
            $section_and_module['section'] = $args[$section_arg_name];
        } else {
            echo $section_question;
            
            $section_and_module['section'] = CLIScripts_InputReader::get_choice_from_string('haddock plug-ins project-specific');
            
            if (!isset($section_and_module['section'])) {
                echo "Quitting!\n";
                exit;
            }
        }
        
        $pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
        $project_directory = $pdf->get_project_directory_for_this_project();
        
        if ($section_and_module['section'] != 'project-specific') {
            if (isset($args[$module_arg_name])) {
                $section_and_module['module'] = $args[$module_arg_name];
            } else {
                if ($section_and_module['section'] == 'haddock') {
                    $module_directories = $project_directory->get_core_module_directories();
                } else if ($section_and_module['section'] == 'plug-ins') {
                    $module_directories = $project_directory->get_plug_in_module_directories();
                }
                
                $choice_str = '';
                $first = TRUE;
                foreach ($module_directories as $md) {
                    if ($first) {
                        $first = FALSE;
                    } else {
                        $choice_str .= ' ';
                    }
                    
                    $choice_str .= $md->get_identifying_name();
                }
                
                echo $module_question;
                
                $section_and_module['module'] = CLIScripts_InputReader::get_choice_from_string($choice_str);
                
                if (!isset($section_and_module['module'])) {
                    echo "Quitting!\n";
                    exit;
                }
            }
        } else {
            if (isset($args[$module_arg_name])) {
                throw new Exception('No module should be set if the section is project-specific!');
            }
        }
        
        return $section_and_module;
    }
}
?>
