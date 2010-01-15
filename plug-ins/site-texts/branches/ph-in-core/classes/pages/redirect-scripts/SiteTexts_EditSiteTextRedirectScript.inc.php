<?php
/**
 * SiteTexts_EditSiteTextRedirectScript
 *
 * Writes the new site-text contents from $_POST 
 * over the old file (path name also in $_POST)
 * 
 * @copyright 2009-06-13, Saul Howard
 */


class
SiteTexts_EditSiteTextRedirectScript
extends
PublicHTML_RedirectScript                                                                                                          
{
	protected function
		do_actions() 
	{
		//print_r($_POST);exit;

		/** EXAMPLE FORM POST
		 *<textarea name="contents">
		 *$contents
		 *</textarea>
		 *<input type="hidden" name="filter_function" value="$filter_function" />
		 *<input type="hidden" name="page" value="$page" />
		 *<input type="hidden" name="section" value="$section" />
		 *<input type="hidden" name="language" value="$name" />
		 *<input type="hidden" name="path" value="$path" />
		 *<input type="submit" value="Edit" /> 
		 */

		$return_url = $this->get_redirect_script_return_url();

		if (
			(isset($_POST['contents']))
			&&
			(isset($_POST['filter_function']))
			&&
			(isset($_POST['page']))
			&&
			(isset($_POST['section']))
			&&
			(isset($_POST['language']))
			&&
			(isset($_POST['path']))
		) {
			$path = $_POST['path'];
			//$contents = html_entity_decode($_POST['contents'], ENT_NOQUOTES, "UTF-8");
                        //

			$contents = stripslashes($_POST['contents']);
                        $contents = trim($contents);
                        $contents = "\n\r" . $contents;

			$contents = $_POST['filter_function'] .  $contents;
			//print_r($contents);exit;

			/*
			 *Open the file and write over it
			 */
			try 
			{
				if (is_writable($path)) {

					if (!$handle = fopen($path, 'w')) {
						throw new Admin_FileException('Could not open file ' .$path);
					}
					if (fwrite($handle, $contents) === FALSE) {
						throw new Admin_FileException('Could not write to file ' .$path);
					}

					fclose($handle);

				} else {
					throw new Admin_FileException('File ' .$path . ' is not writable.');
				}
			}
			catch (Admin_FileException $e)
			{
				$return_url->set_get_variable('error', urlencode($e->getMessage()));

			}
			$return_url->set_get_variable('page', $_POST['page']);
			$return_url->set_get_variable('section', $_POST['section']);
			$return_url->set_get_variable('edited', '1');
		}
		$this->set_return_to_url($return_url);
	}

	private function     
		get_redirect_script_return_url()     
	{
		return SiteTexts_AdminHelper::get_admin_manage_site_texts_url();     
	}
}       
?> 
