<?php
/**
 * FileSystem_XMLFile
 *
 * @copyright 2007-05-08, RFI
 */

#require_once PROJECT_ROOT
#	. '/haddock/file-system/classes/'
#	. 'FileSystem_TextFile.inc.php';

/**
 * A thin wrapper around a DOMDocument.
 */
class
	FileSystem_XMLFile
extends
	FileSystem_TextFile
{
	private $xml_version;
	private $encoding;
	
	private $dom_document;
	
	private $simple_xml_element;
	
	public function
		get_xml_version()
	{
		if (!isset($this->xml_version)) {
			$this->xml_version = '1.0';
		}
		
		return $this->xml_version;
	}
	
	public function
		set_xml_version($xml_version)
	{
		$this->xml_version = $xml_version;
	}
	
	public function
		get_encoding()
	{
		if (!isset($this->encoding)) {
			$this->encoding = 'UTF-8';
		}
		
		return $this->encoding;
	}
	
	public function
		set_encoding($encoding)
	{
		$this->encoding = $encoding;
	}
	
	public function
		get_dom_document()
	{
		if (!isset($this->dom_document)) {
			if ($this->is_file()) {
				$this->dom_document = DOMImplementation::createDocument();
				
				$file_name = $this->get_name();
				
				#echo "\$file_name: $file_name\n";
				
				$this->dom_document->load($file_name);
			} else {
				$this->dom_document
					= new DOMDocument(
						$this->get_xml_version(),
						$this->get_encoding()
					);
			}
		}
		
		return $this->dom_document;
	}
	
	public function
		set_dom_document(
			DOMDocument $dom_document
		)
	{
		$this->dom_document = $dom_document;
	}
	
	public function
		commit()
	{
		$dom_document = $this->get_dom_document();
		
		#$dom_document->save($this->get_name());
		
		if ($fh = fopen($this->get_name(), 'w')) {            
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

	public function
		get_simple_xml_element()
	{
		$dd = $this->get_dom_document();
		
		#print_r($dd);
		
		if (!isset($this->simple_xml_element)) {
			$this->simple_xml_element = simplexml_import_dom($dd);
		}
		
		return $this->simple_xml_element;
	}
}
?>