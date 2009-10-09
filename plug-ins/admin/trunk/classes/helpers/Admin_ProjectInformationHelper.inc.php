<?php
/**
 * Admin_ProjectInformationHelper
 *
 * @copyright 2009-10-10, Robert Impey
 */

class
	Admin_ProjectInformationHelper
{
	public static function
		get_start_page_widget_content()
	{
		$ul = new HTMLTags_UL();

		$info = array(
			'Title' => HaddockProjectOrganisation_ProjectInformationHelper::get_title(),
			'Version' => HaddockProjectOrganisation_ProjectInformationHelper::get_version_code(),
			'Copyright Holder' => HaddockProjectOrganisation_ProjectInformationHelper::get_copyright_holder()
		);

		$dl = new HTMLTags_DL();
		foreach ($info as $key => $value)
		{
			$dt = new HTMLTags_DT($key . ':&nbsp;');
			$dd = new HTMLTags_DD($value);

			$dl->append($dt);
			$dl->append($dd);
		}
		
		return $dl;
	}
}
?>