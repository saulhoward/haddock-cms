<?php
/**
 * PublicHTML_ExceptionPage
 *
 * @copyright Clear Line Web Design, 2008-02-05
 */

abstract class
	PublicHTML_HTMLPage
extends
	PublicHTML_HTTPResponseWithMessageBody
{
	#public function
	#	send_http_headers()
	#{
	#	parent::send_http_headers();
	#	#header('Content-type: application/xhtml+xml');
	#}
	
	public function
		render()
	{
		$this->render_doctype();
		$this->render_html();
	}
	
	public function
		render_doctype()
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	}
	
	public function
		render_html()
	{
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php
		$this->render_head();
		$this->render_body();
?>
</html>
<?php
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the HTML head.
	 * ----------------------------------------
	 */
	
	public function
		render_head()
	{
		#print_r($this); exit;
		#var_dump($this instanceof PublicHTML_HTMLPage); exit;
		
?>
<head>
	<title><?php echo $this->get_head_title(); ?></title>
	<meta
		name="author"
		content="Clear Line Web Design"
	/>
	<meta
		name="keywords"
		content="<?php echo $this->get_head_meta_keywords(); ?>"
	/>
	<meta
		name="description"
		content="<?php echo $this->get_head_meta_description(); ?>"
	/>
<?php $this->render_head_link_stylesheet(); ?>
	<link
		rel="Shortcut Icon"
		type="image/ico"
		href="/favicon.ico"
	/>
<?php $this->render_head_script_javascript(); ?>
</head>
<?	
	}
	
	public function
		get_head_title()
	{
		return $this->get_project_title();
	}
	
	public function
		get_head_meta_keywords()
	{
		return 'haddock, clearlinewebdesign, PHP, object-oriented, content management system';
	}
	
	public function
		get_head_meta_description()
	{
		return 'A page written using the Haddock CMS Framework.';
	}
	
	protected function
		render_head_link_stylesheet()
	{
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'http://yui.yahooapis.com/2.3.1/build/base/base-min.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/haddock/public-html/public-html/styles/styles.css'
			);
	}
	
	/**
	 * This is a bit ugly but I'm not sure how else to do this.
	 *
	 * The default action is to print nothing but this can be extended.
	 */
	public function
		render_head_script_javascript()
	{
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the HTML body.
	 * ----------------------------------------
	 */
	
	public function
		render_body()
	{
		$this->render_body_tag_open();
		
		$this->render_body_div_header();
		
		$this->render_body_div_content();
		
		$this->render_body_div_navigation();
		
		$this->render_body_div_footer();
		
		echo "</body>\n";
	}
	
	/**
	 * e.g.
	 *	- onload in JS.
	 */
	public function
		render_body_tag_open()
	{
		echo "<body>\n";
	}
	
	public function
		render_body_div_header()
	{
		/*
		 * Create the HTML tags objects.
		 */
		$div_header = new HTMLTags_Div();
		$div_header->set_attribute_str('id', 'header');
		
		$h1_title = new HTMLTags_Heading(1);
		
		$h1_title->append_str_to_content(
			$this->get_body_div_header_heading_content()
		);
		
		$div_header->append_tag_to_content($h1_title);
		
		echo $div_header->get_as_string();
	}
	
	/**
	 * The content of the heading of the page.
	 *
	 * You could override this to change the heading in the masthead of
	 * a page.
	 */
	protected function
		get_body_div_header_heading_content()
	{
		$home_link = new HTMLTags_A($this->get_body_div_header_link_content());
		
		$home_link->set_href(new HTMLTags_URl('/'));
		
		return $home_link->get_as_string();
	}
	
	protected function
		get_project_title()
	{
		/*
		 * Find the module config manager.
		 */
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = $cmf->get_config_manager('haddock', 'haddock-project-organisation');
		
		return $config_manager->get_project_name();
	}
	
	protected function
		get_body_div_header_link_content()
	{
		return $this->get_project_title();
	}
	
	/**
	 * The content div is where the meat of the page lives.
	 */
	public function
		render_body_div_content()
	{
?>
<div id="content">
<?php
		$this->content();
?>
</div>
<!-- End of content div -->
<?php
	}
	
	/**
	 * This function should be implemented in classes that display
	 * something.
	 *
	 * The function name doesn't follow the naming convention of
	 * the rest of the functions.
	 *
	 * This is because it will be implemented billions of times.
	 */
	abstract public function
		content();
	
	protected function
		get_navigation_pages()
	{
		$navigation_pages[] = array(
			'page-class' => 'PublicHTML_HTMLPage',
			'href' => '/',
			'title' => 'Home',
			'text' => 'Home'
		);
		
		return $navigation_pages;
	}
	
	public function
		render_body_div_navigation()
	{
?>
<div id="navigation">
<?php
		$navigation_pages = $this->get_navigation_pages();
		
		# Render the links.
		echo "<ul>\n";
		foreach ($navigation_pages as $navigation_page) {
			echo '<li';
			
			if (isset($_GET['page-class'])) {
				if ($_GET['page-class'] == $navigation_page['page-class']) {
					echo ' class="selected"';
				}
			}
			
			echo ">\n";
			
			echo '<a ';
			echo 'href="' . $navigation_page['href'] . '" ';
			echo 'title="' . $navigation_page['title'] . '"';
			echo '>';
			
			echo $navigation_page['text'];
			echo "</a>\n";
			
			echo "</li>\n";
		}
		echo "</ul>\n";
?>
</div>
<?php
	}
	
	public function
		render_body_div_footer()
	{
?>
<div
    id="footer"
>
</div>
<?php
	}
}
?>