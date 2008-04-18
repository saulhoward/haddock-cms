<?php
/**
 * HTMLTags_ConfirmationP
 *
 * @copyright 2007-08-30, RFI
 */

class
	HTMLTags_ConfirmationP
extends
	HTMLTags_P
{
	private $question;
	private $action;
	private $cancel;
	private $yes_str;
	private $no_str;

	public function
		__construct(
			$question,
			$action,
			$cancel,
			$yes_str = 'Yes',
			$no_str = 'No'
		)
	{
		parent::__construct();
		
		$this->question = $question;
		$this->action = $action;
		$this->cancel = $cancel;
		$this->yes_str = $yes_str;
		$this->no_str = $no_str;
	}

	public function
		get_content()
	{
		$content = new HTMLTags_TagContent();
		
		$content->append_str($this->question);
		
		$content->append_tag(new HTMLTags_BR());
		
		$action_a = new HTMLTags_A($this->yes_str);
		
		$action_a->set_href($this->action);
		
		$content->append_tag($action_a);
		
		$content->append_str('&nbsp;');
		
		$cancel_a = new HTMLTags_A($this->no_str);
		
		$cancel_a->set_href($this->cancel);
		
		$content->append_tag($cancel_a);
		
		return $content;
	}
}
?>