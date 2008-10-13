<?php
/**
 * RSS_RSS
 *
 * @copyright 2006-11-27, RFI
 * @copyright 2008-04-06, RFI
 * @copyright 2008-04-25, SANH
 */

/**
 *  RSS Feeds
 *
 */

class
	RSS_RSS
{
	private $xml;

	public function
		__construct(
			$url
			)
	{
//                parent::__construct();
		# INSTANTIATE CURL.
		$curl = curl_init();

		# CURL SETTINGS.
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);

		# GRAB THE XML FILE.
		$xml_data = curl_exec($curl);

		curl_close($curl);

		# SET UP XML OBJECT.
//                $xmlObj = simplexml_load_string($xmlTwitter);
//                $xmlObj = new SimpleXMLElement($xml_data);
		$this->xml = simplexml_load_string($xml_data, 'SimpleXMLElement', LIBXML_NOCDATA);

//                print_r($this->xml);exit;
	}

	public function
		get_xml()
	{
		return $this->xml;
	}

	public function
		get_feed_title()
	{
		return (string) $this->xml->title;
	}

}
?>
