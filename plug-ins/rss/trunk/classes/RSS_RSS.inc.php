<?php
/**
 * RSS_RSS
 *
 * @copyright 2008-10-14, SANH
 *
 * RSS Feeds structure which grabs the xml file and 
 * contains the resultant SimpleXMLElement class as 
 * a private variable and exposes some of it's 
 * functions as well.
 *
 */

class
	RSS_RSS
{
	private $xml;

	public function
		__construct(
			$url, // RSS absolute url
			$version // 'Atom' or 'RSS2' so we know which class to use
			)
	{
		$timeout = 1;

		# INSTANTIATE CURL.
		$curl = curl_init();

		# CURL SETTINGS.
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

		# GRAB THE XML FILE.
		$xml_data = curl_exec($curl);

		curl_close($curl);

		if (empty($xml_data))
		{
			throw new Exception('Curl returned empty file');
		}
		else
		{
			if (strtolower($version) == 'atom')
			{
				$class_to_return = 'RSS_AtomSimpleXMLElement';
			}
			elseif (strtolower($version) == 'rss2')
			{
				$class_to_return = 'RSS_RSSSimpleXMLElement';

			}

			# SET UP XML OBJECT.
//                        if (!$this->xml = simplexml_load_string(
//                                $xml_data,
//                                $class_to_return,
//                                LIBXML_NOCDATA
//                        ))
//                        {
//                                throw new Exception('Error reading XML');
//                        }

			try 
			{
				$this->xml = new $class_to_return(
					$xml_data
				);
			}
			catch (Exception $e)
			{
				throw new Exception('Error reading XML');
			}

			// print_r($this->xml);exit;

			return 1;
		}
	}

	public function
		get_xml()
	{
		return $this->xml;
	}

	public function
		get_items()
	{
		return $this->xml->get_items();
	}

	public function
		get_feed_title()
	{
		return $this->xml->get_feed_title();
	}
}
?>
