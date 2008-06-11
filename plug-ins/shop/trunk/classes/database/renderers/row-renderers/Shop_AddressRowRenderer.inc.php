<?php
/**
 * Shop_AddressRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */


require_once PROJECT_ROOT
. '/haddock/html-tags/classes/standard/'
. 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_Abbr.inc.php';

require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_BR.inc.php';

require_once PROJECT_ROOT
	. '/haddock/formatting/classes/'
	. 'Formatting_DateTime.inc.php';

require_once PROJECT_ROOT
	. '/haddock/database/classes/renderers/'
	. 'Database_RowRenderer.inc.php';

class
	Shop_AddressRowRenderer
	extends
	Database_RowRenderer
{
	public function
		get_short_address_td()
	{
		$address = $this->get_element();

		$address_td = new HTMLTags_TD($address_text);
		$address_td->set_attribute_str('style', 'text-align: left');

		if ($address->has_post_office_box())
		{
			$address_td->append_str_to_content($address->get_post_office_box());

			$address_td->append_tag_to_content(new HTMLTags_BR());
		}
		if ($address->has_extended_address())
		{
			$address_td->append_str_to_content($address->get_extended_address());
			$address_td->append_tag_to_content(new HTMLTags_BR());
		}

		$address_td->append_str_to_content($address->get_street_address());
		$address_td->append_tag_to_content(new HTMLTags_BR());

		$address_td->append_str_to_content($address->get_locality());
		$address_td->append_tag_to_content(new HTMLTags_BR());

		$address_td->append_str_to_content($address->get_region());
		$address_td->append_tag_to_content(new HTMLTags_BR());

		$address_td->append_str_to_content($address->get_postal_code());
		$address_td->append_tag_to_content(new HTMLTags_BR());

		$address_td->append_str_to_content($address->get_country_name());

		return $address_td;
	}
	
	public function
		get_short_address_ul()
	{
		$address = $this->get_element();

		$address_ul = new HTMLTags_UL($address_text);

		if ($address->has_post_office_box())
		{
			$p_o_li = new HTMLTags_LI($address->get_post_office_box());
			$address_ul->append_tag_to_content($p_o_li);
		}
		if ($address->has_extended_address())
		{

			$extended_address_li = new HTMLTags_LI($address->get_extended_address());
			$address_ul->append_tag_to_content($extended_address_li);
		}

		$address_ul->append_tag_to_content(new HTMLTags_LI($address->get_street_address()));

		$address_ul->append_tag_to_content(new HTMLTags_LI($address->get_locality()));

		$address_ul->append_tag_to_content(new HTMLTags_LI($address->get_region()));

		$address_ul->append_tag_to_content(new HTMLTags_LI($address->get_postal_code()));

		$address_ul->append_tag_to_content(new HTMLTags_LI($address->get_country_name()));

		return $address_ul;
	}

}
?>
