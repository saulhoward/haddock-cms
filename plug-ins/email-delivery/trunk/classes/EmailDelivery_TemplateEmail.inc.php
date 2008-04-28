<?php
/**
 * EmailDelivery_TemplateEmail
 *
 * @copyright 2008-04-29, RFI
 */

class
	EmailDelivery_TemplateEmail
extends
	EmailDelivery_Email
{
	private $subject_template;
	
	private $body_template;

	private $template_variables;
	
	public function
		get_subject_template()
	{
		if (!isset($this->subject_template)) {
			throw new Exception('The subject template must be set!');
		}
		
		return $this->subject_template;
	}
	
	public function
		set_subject_template(
			$subject_template
		)
	{
		$this->subject_template  = $subject_template;
	}
	
	public function
		get_subject()
	{
		return
			Templates_TemplateHelper
				::expand_variables(
					$this->get_subject_template(),
					$this->get_template_variables()
				);
	}
	
	public function
		get_body_template()
	{
		if (!isset($this->body_template)) {
			throw new Exception('The body template must be set!');
		}
		
		return $this->body_template;
	}
	
	public function
		set_body_template(
			$body_template
		)
	{
		$this->body_template  = $body_template;
	}
	
	public function
		get_body()
	{
		return
			Templates_TemplateHelper
				::expand_variables(
					$this->get_body_template(),
					$this->get_template_variables()
				);
	}
	
	public function
		add_template_variable(
			$name,
			$value
		)
	{
		$this->template_variables[$name] = $value;
	}
	
	public function
		get_template_variables()
	{
		ksort($this->template_variables);
		
		return $this->template_variables;
	}
}
?>