<?php
/**
 * Create the XML for the AJAX DBC page.
 *
 * @copyright Clear Line Web Design, 2007-05-02
 */

$dom = new DOMDocument();

$response = $dom->createElement('response');
$dom->appendChild($response);

$responseText = $dom->createTextNode('Hello, world!');

$response->appendChild($responseText);

echo $dom->saveXML();
?>
