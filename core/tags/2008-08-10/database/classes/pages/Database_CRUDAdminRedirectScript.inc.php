<?php
/**
 * Database_CRUDAdminRedirectScript
 * 
 * @copyright 2007-12-18, RFI
 */

abstract class
	Database_CRUDAdminRedirectScript
extends
	Admin_RestrictedRedirectScript
{
	protected function
		do_actions()
	{
		if (isset($_GET['action'])) {
			/*
			 * The action name.
			 */
			$an = $_GET['action'];
			
			$amm = $this->get_action_method_map();
			
			/*
			 * The acton method name.
			 */
			if (isset($amm[$an])) {
				$amn = $amm[$an];
			} else {
				throw new Exception("Unknown action '$an'!");
			}
			
			/*
			 * Do it.
			 */
			try {
				ObjectOrientation_NamedMethodCaller::call_method_by_name($this, $amn);
				
				/*
				 * Is this actually necessary?
				 *
				 * They will all get set again when the user is taken
				 * back to the page.
				 *
				 * Does no harm and the user might be returning to a page
				 * other than the standard crud.
				 */
				if (isset($_SESSION['select-vars'])) {
					unset($_SESSION['select-vars']);
				}
			#} catch (ReflectionException $e) {
			#	echo $e->getMessage();
			#	exit;
			} catch (Database_CRUDException $e) {
				/*
				 * If there was a problem changing the database,
				 * go back to whence we came.
				 *
				 * Hope that the session vars have been set for
				 * any forms.
				 *
				 * Also hope that the browser isn't playing silly buggars with
				 * the HTTP_REFERER field.
				 */
				$return_to = HTMLTags_URL::parse_and_make_url($_SERVER['HTTP_REFERER']);
				
				$return_to->set_get_variable('error', urlencode($e->getMessage()));
				
				#print_r($return_to); exit;
				
				$this->set_return_to($return_to->get_as_string());
			}
			
		} else {
			throw new Exception('No action set for Database_CRUDAdminRedirectScript!');
		}
	}
	
	/**
	 * See Database_CRUDAdminPage::get_content_render_method_map()
	 *
	 * I know that there is a one-to-one mapping but using a map like that
	 * ensures that users can't just call any public method.
	 */
	protected function
		get_action_method_map()
	{
		$crmm = array();
		
		$crmm['add_something'] = 'add_something';
		$crmm['edit_something'] = 'edit_something';
		$crmm['delete_something'] = 'delete_something';
		$crmm['delete_everything'] = 'delete_everything';
		$crmm['clear_form'] = 'clear_form';
		
		return $crmm;
	}
	
	/*
	 * ----------------------------------------
	 * Functions that do the CRUD'y things.
	 *
	 * Once again, these are not really <code>public</code> methods.
	 * They are meant to be <code>protected</code> but that won't work
	 * with the reflection bollocks.
	 *
	 * If something goes wrong in one of these methods,
	 * you should throw a Database_CRUDException.
	 * This will take the user back to the form and the message will
	 * be printed.
	 * ----------------------------------------
	 */
	
	abstract public function
		add_something();
		
	abstract public function
		edit_something();
		
	abstract public function
		delete_something();
		
	abstract public function
		delete_everything();
		
	public function
		clear_form()
	{
		$acm = $this->get_admin_crud_manager();
		
		$acm->clear_form();
	}
	
	protected function
		get_required_fields()
	{
		return array();
	}
	
	protected function
		set_required_fields_in_session_array()
	{
		$acm = $this->get_admin_crud_manager();
		
		$rf_s = $this->get_required_fields();
		
		#print_r($rf_s); exit;
		
		foreach ($rf_s as $rf) {
			if (isset($_POST[$rf])) {
				$acm->set_form_session_var($rf, $_POST[$rf]);
			}
		}
		
		#print_r($session_array); exit;
	}
	
	protected function
		check_that_all_required_fields_have_been_set()
	{
		foreach ($this->get_required_fields() as $k) {
			if (
				!isset($_POST[$k])
				||
				(strlen($_POST[$k]) < 1)
			) {
				throw new Database_CRUDException("'$k' must be set!");
			}
		}
		
		return TRUE;
	}
	
	abstract protected function
		get_admin_crud_manager_class_name();
		
	protected function
		get_admin_crud_manager()
	{
		$cn = $this->get_admin_crud_manager_class_name();
		
		$rc = new ReflectionClass($cn);
		
		$acm = $rc->newInstance();
		
		return $acm;
	}
}
?>