<?php
/**
 * HaddockProjectOrganisation_ModuleConfigXMLFile
 *
 * @copyright Clear Line Web Design, 2007-09-29
 */

/**
 * Represents an XML file that configures a module.
 *
 * This is no longer the preferred way of doing this.
 *
 * You should probably use the config managers.
 */
class
	HaddockProjectOrganisation_ModuleConfigXMLFile
extends
    HaddockProjectOrganisation_AbstractModuleConfigXMLFile
{
	protected function
        get_required_node($node_name)
    {
        $dom_document = $this->get_dom_document();
        
		/*
		 * Shouldn't this be node name?
		 */
        #$nodes = $dom_document->getElementsByTagName('payment-plug-ins');
        $nodes = $dom_document->getElementsByTagName($node_name);
        
        if ($nodes->length == 1) {
            return $nodes->item(0);
        } else {
            throw new ErrorHandling_SprintfException(
                'There should be exactly 1 \'%s\' node in \'%s\', %d found!',
                array(
                    $node_name,
                    $this->get_name(),
                    $project_specific_file_nodes->length
                )
            );
        }
    }
	
    //private function
    //    get_project_specific_config_file_nodes()
    //{
    //    $dom_document = $this->get_dom_document();
    //    
    //    $project_specific_config_file_nodes
    //        = $dom_document->getElementsByTagName('project-specific-config-file');
    //    
    //    return $project_specific_config_file_nodes;
    //}
    //
    //private function
    //    get_project_specific_config_file_node()
    //{
    //    $project_specific_config_file_nodes
    //        = $this->get_project_specific_config_file_nodes();
    //    
    //    if ($project_specific_config_file_nodes->length == 1) {
    //        return $project_specific_config_file_nodes->item(0);
    //    } else {
    //        throw new ErrorHandling_SprintfException(
    //            'There should be exactly 1 project-specific-config-file node, %d found!',
    //            array($project_specific_file_nodes->length)
    //        );
    //    }
    //}
    //
    //public function
    //    has_project_specific_config_file_class_name()
    //{
    //    $project_specific_config_file_nodes
    //        = $this->get_project_specific_config_file_nodes();
    //    
    //    if ($project_specific_config_file_nodes->length == 1) {
    //        $project_specific_config_file_node
    //            = $project_specific_config_file_nodes->item(0);
    //        
    //        return $project_specific_config_file_node->hasAttribute('class-name');
    //    }
    //    
    //    return FALSE;
    //}
    //
    //public function
    //    get_project_specific_config_file_class_name()
    //{
    //    $project_specific_config_file_node = $this->get_project_specific_config_file_node();
    //    
    //    if ($project_specific_config_file_node->hasAttribute('class-name')) {
    //        return $project_specific_config_file_node->getAttribute('class-name');
    //    } else {
    //        throw new ErrorHandling_SprintfException(
    //            '\'class-name\' not set for the project-specific config file in \'%s\'!',
    //            array($this->get_name())
    //        );
    //    }
    //}
}
?>