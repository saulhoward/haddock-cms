<?php
/**
 * HaddockProjectOrganisation_ConfigFile
 *
 * @copyright Clear Line Web Design, 2007-09-29
 */

#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_AbstractModuleConfigXMLFile.inc.php';

/**
 * Represents a config file in a haddock project.
 * 
 * Client code should not use this class directly.
 * Instead, you should use a sub-class of
 * HaddockProjectOrganisation_ConfigManager
 */
class
	HaddockProjectOrganisation_ConfigFile
extends
	FileSystem_XMLFile
{
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
    
#    protected function
#        get_required_node($node_name)
#    {
#        $dom_document = $this->get_dom_document();
#        
#        $nodes = $dom_document->getElementsByTagName('payment-plug-ins');
#        
#        if ($nodes->length == 1) {
#            return $nodes->item(0);
#        } else {
#            throw new ErrorHandling_SprintfException(
#                'There should be exactly 1 \'%s\' node in \'%s\', %d found!',
#                array(
#                    $node_name,
#                    $this->get_name(),
#                    $project_specific_file_nodes->length
#                )
#            );
#        }
#    }


    /**
     * It is assumed that the config files will have a main
     * node called 'config'.
     */
    protected function
        get_config_node()
    {
        $dom_document = $this->get_dom_document();
        
        $config_nodes = $dom_document->getElementsByTagName('config');
        
        if ($config_nodes->length == 1) {
            return $config_nodes->item(0);
        } else {
            throw new HaddockProjectOrganisation_ModuleConfigException(
                '\'%s\' has %d config nodes, 1 expected!',
                array(
                    $this->get_name(),
                    $config_nodes->length
                )
            );
        }
    }
    
    private static function
        get_value_from_element(
            DOMElement $element
        )
    {
#	    echo "getting value from node\n";
#	    echo '$element->nodeName: ' . $element->nodeName . "\n";

        if ($element->hasAttribute('value')) {
            return $element->getAttribute('value');
        }
#		echo "attribute not set\n";
#		echo $element->childNodes->length . "\n";
        if ($element->childNodes->length > 0) {
#		echo "Found value between tags of node\n";

            return $element->nodeValue;
        }

#	echo "the child nodes: \n";
		
#	for (
#		$i = 0;
#		$i < $element->childNodes->length;
#		$i++ 
#	) {
#		if (get_class($element->childNodes->item($i)) == 'DOMText') {
#			echo '$element->childNodes->item($i)->wholeText: ' . $element->childNodes->item($i)->wholeText . "\n";
#		} else {
#			echo '$element->childNodes->item($i): ' . $element->childNodes->item($i) . "\n";
#		}
#	}
        
        return NULL;
    }
    
    /**
     * e.g.
     *
     * If <MODULE_DIR>/config/config.xml looks
     * like:
     * 
     *  <?xml version="1.0" encoding="UTF-8"?>
     *  <config>
     *      <bar
     *          value="foo"
     *      />
     *  </config>
     *
     *  then $config_file->get_value('bar') would return 'foo'.
     *
     * If <MODULE_DIR>/config/config.xml looks
     * like:
     * 
     *  <?xml version="1.0" encoding="UTF-8"?>
     *  <config>
     *      <bar>
     *          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
     *          accusantium doloremque laudantium, totam rem aperiam, eaque
     *          ipsa quae ab illo inventore veritatis et quasi architecto beatae
     *          vitae dicta sunt explicabo.
     *      </bar>
     *  </config>
     *
     *  then $config_file->get_value('bar') would return the text between the
     *  'bar' tags.
     */
    public function
        get_value(
            $key
        )
    {
        $config_node = $this->get_config_node();
        
        $key_nodes = $config_node->getElementsByTagName($key);
        
        if ($key_nodes->length == 1) {
            $key_node = $key_nodes->item(0);
            
            //if ($key_node->hasAttribute('value')) {
            //    return $key_node->getAttribute('value');
            //}
            //
            //if ($key_node->childNodes->length == 1) {
            //    return $key_node->nodeValue;
            //}
            $value = NULL;
            
            $value = self::get_value_from_element($key_node);
            
            if (isset($value)) {
                return $value;
            }
        }
        
        throw new HaddockProjectOrganisation_ModuleConfigException(
            'No value for key \'%s\' found in \'%s\'!',
            array(
                $key,
                $this->get_name()
            )
        );
    }
    
    public function
        has_value(
            $key
        )
    {
        try {
            $value = $this->get_value($key);
            
            if (isset($value)) {
                if (strlen($value) > 0) {
                    return TRUE;
                }
            }
        } catch (HaddockProjectOrganisation_ModuleConfigException $e) {
            
        }
        
        return FALSE;
    }
	/**
	 * Searches the XML file for the value nested in nodes with the given names.
	 * 
	 * Is there not a library function that does this?
	 * 
	 * This is not the most efficient way of doing this.
	 * 
	 * We could read the contents of the XML file using the SAX library and put all
	 * the variables into an assoc array.
	 * 
	 * That implementation might be less efficient as well, as it would involve reading the entire
	 * XML file with PHP.
	 * 
	 * Yet another implementation would be to write an extension to PHP with a native language
	 * that read all the XML files in a project and returned values for given keys.
	 * This extension could set up a persistent resourse that could be made available to all
	 * requests.
	 * That's pretty horrible, isn't it?
	 * Better wait until we've established how much of a performance hit the config managers
	 * are.
	 */ 
    public function
        get_nested_value(
            array $element_names
        )
    {
#	echo $this->get_name() . "\n";
#	print_r($element_names);
#	exit;

        $dom_document = $this->get_dom_document();
        
        $config_nodes = $dom_document->getElementsByTagName('config');
        
        if ($config_nodes->length == 1) {
            $config_node = $config_nodes->item(0);
            
            $parent_node = $config_node;
            
            $count_e_n = count($element_names);
            
            $desired_node = NULL;
            
            for (
                $i = 0;
                $i < $count_e_n;
                $i++
            ) {
#		    echo $element_names[$i] . "\n";

                $child_nodes = $parent_node->getElementsByTagName(
                    $element_names[$i]
                );
		
#		echo $child_nodes->length . "\n";

		if ($child_nodes->length != 1) {
                    return NULL;
                }
                
                if ($i < ($count_e_n - 1)) {
#			echo "keep going.\n";
                    $parent_node = $child_nodes->item(0);
                } else {
#			echo "found desired node.\n";
                    $desired_node = $child_nodes->item(0);
                }
            }
            
            if (isset($desired_node)) {
                $value = NULL;
                
#		echo "getting value from node\n";

                $value = self::get_value_from_element($desired_node);
                
                if (isset($value)) {
                    return $value;
                }
            }
        }
        
        return NULL;
    }

	public function
		get_nested_value_str($element_names_str)
	{
		return $this->get_nested_value(explode(' ', $element_names_str));
	}

    public function
        has_nested_value(
            array $element_names
        )
    {
        $nv = NULL;
        
        $nv = $this->get_nested_value($element_names);
        
        if (isset($nv)) {
            return TRUE;
        }
        
        return FALSE;
    }

	public function
		has_nested_value_str($element_names_str)
	{
		return $this->has_nested_value(explode(' ', $element_names_str));
	}
}
?>
