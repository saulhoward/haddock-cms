<?php
/**
 * HaddockProjectOrganisation_RequiredModulesFile
 *
 * @copyright Clear Line Web Design, 2007-07-31
 */

class
	HaddockProjectOrganisation_RequiredModulesFile
extends
    FileSystem_XMLFile
{
	private $required_modules;
	
    public function
        get_required_modules()
    {
		if (!isset($this->required_modules)) {
			$this->required_modules = array();
			
			$dom_document = $this->get_dom_document();
			
			foreach (
				$dom_document->getElementsByTagName('module')
				as
				$module_node
			) {
				$this->required_modules[] = $module_node->getAttribute('name');
			}
		}
		
		return $this->required_modules;
    }
	
	public function
		get_required_plug_in_module_names()
	{
		return $this->get_required_modules();
	}
	
	public function
		empty_required_modules()
	{
		$this->required_modules = array();
        
        $dom_document = $this->get_new_xml_document();
        
        $this->set_dom_document($dom_document);
	}
	
	public function
		add_module_directory(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$this->required_modules[] = $module_directory->get_identifying_name();
	}
	
	public function
		commit()
	{
		$required_modules = $this->get_required_modules();
		
		$dom_document = $this->get_dom_document();
		
		$modules_node = $dom_document->createElement('modules');
		$dom_document->appendChild($modules_node);
		
		foreach ($required_modules as $rm) {
			$module_node = $dom_document->createElement('module');
			
			$module_node->setAttribute('name', $rm);
			
			$modules_node->appendChild($module_node);
		}
		
		parent::commit();
	}
    
    protected function
        get_new_xml_document()
    {
        return new DOMDocument('1.0', 'UTF-8');
    }
    
    public function
		initialise()
    {
        touch($this->get_name());
        
        if ($fh = fopen($this->get_name(), 'w')) {
            $dom_document = $this->get_new_xml_document();
            
            $plug_ins_node = $dom_document->createElement('modules');
            $dom_document->appendChild($plug_ins_node);
            
            //echo '$dom_document->saveXML(): ' . "\n";
            //echo $dom_document->saveXML();
            
            fwrite($fh, $dom_document->saveXML());
            
            fclose($fh);
        } else {
            throw new ErrorHandling_SprintfException(
                'Unable to open \'%s\' for writing!',
                array($this->get_name())
            );
        }
    }
}
?>
