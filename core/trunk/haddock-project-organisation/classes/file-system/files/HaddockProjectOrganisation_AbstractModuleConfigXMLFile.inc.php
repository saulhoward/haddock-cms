<?php
/**
 * HaddockProjectOrganisation_AbstractModuleConfigXMLFile
 *
 * @copyright 2007-10-01, RFI
 */

/**
 * Could be one of
 *  - HaddockProjectOrganisation_ModuleConfigXMLFile
 *  - HaddockProjectOrganisation_PSModuleConfigFile
 *  - HaddockProjectOrganisation_ISModuleConfigFile
 */
abstract class
	HaddockProjectOrganisation_AbstractModuleConfigXMLFile
extends
	FileSystem_XMLFile
{
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
		if ($element->hasAttribute('value')) {
			return $element->getAttribute('value');
		}
		
		if ($element->childNodes->length == 1) {
			return $element->nodeValue;
		}
		
		return NULL;
	}
	
	/**
	 * e.g.
	 *
	 * If <MODULE_DIR>/haddock-project-organisation/config.xml looks
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
	 * If <MODULE_DIR>/haddock-project-organisation/config.xml looks
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
	
	public function
		get_nested_value(
			array $element_names
		)
	{
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
				$child_nodes = $parent_node->getElementsByTagName(
					$element_names[$i]
				);
				
				if ($child_nodes->length != 1) {
					return NULL;
				}
				
				if ($i < ($count_e_n - 1)) {
					$parent_node = $child_nodes->item(0);
				} else {
					$desired_node = $child_nodes->item(0);
				}
			}
			
			if (isset($desired_node)) {
				$value = NULL;
				
				$value = self::get_value_from_element($desired_node);
				
				if (isset($value)) {
					return $value;
				}
			}
		}
		
		return NULL;
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
}
?>