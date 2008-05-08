<?php
/**
 * EmailDelivery_Email
 *
 * @copyright 2008-04-28, RFI
 */

class
	EmailDelivery_Email
{
	private $to;
	private $subject;
	private $body;
	private $headers;
	
	private $from;
	private $reply_to;
	private $return_path;
	
	private $cc;
	
	private $bcc;
	
	public function
		__construct(
			$to = NULL,
			$subject = NULL,
			$body = NULL,
			$headers = NULL
		)
	{
		$this->to = $to;
		$this->subject = $subject;
		$this->body = $body;
		$this->headers = $headers;
		
		$this->from = NULL;
		$this->reply_to = NULL;
		$this->return_path = NULL;
		
		$this->cc = NULL;
		$this->bcc = NULL;
	}

	public function 
		get_to()
	{
		if (!isset($this->to)) {
			throw new Exception(
				'The \'to\' field must be set in an EmailDelivery_Email!'
			);
		}
		
		return $this->to;
	}

	public function 
		set_to($to)
	{
		$this->to = $to;
	}

	public function 
		get_subject()
	{
		if (!isset($this->subject)) {
			throw new Exception(
				'The \'subject\' field must be set in an EmailDelivery_Email!'
			);
		}
		
		return $this->subject;
	}

	public function 
		set_subject($subject)
	{
		$this->subject = $subject;
	}

	public function 
		get_body()
	{
		if (!isset($this->to)) {
			throw new Exception(
				'The \'subject\' field must be set in an EmailDelivery_Email!'
			);
		}
		
		return $this->body;
	}

	public function 
		set_body($body)
	{
		$this->body = $body;
	}

	public function 
		get_headers()
	{
		if (!isset($this->headers)) {
			$this->headers = '';
			
			$this->headers .= 'From: ' . $this->get_from() . "\r\n";
			$this->headers .= 'Reply-To: ' . $this->get_reply_to() . "\r\n";
			$this->headers .= 'Return-Path: ' . $this->get_return_path() . "\r\n";
			
			if ($this->has_cc()) {
				$this->headers .= 'Cc: ' . $this->get_cc()  . "\r\n";
			}
			
			if ($this->has_bcc()) {
				$this->headers .= 'Bcc: ' . $this->get_bcc()  . "\r\n";
			}
		}
		
		return $this->headers;
	}

	public function 
		set_headers($headers)
	{
		$this->headers = $headers;
	}
	
	public function 
		get_from()
	{
		if (!isset($this->from)) {
			#throw new Exception(
			#	'The \'from\' field must be set in an EmailDelivery_Email!'
			#);
			$this->from
				= get_current_user()
				. '@'
				#. $_ENV['HOSTNAME']
				. Environment_MachineHelper::get_real_host_name()
			;
		}
		
		return $this->from;
	}

	public function 
		set_from($from)
	{
		$this->from = $from;
	}

	public function 
		get_reply_to()
	{
		if (!isset($this->reply_to)) {
			$this->reply_to = $this->get_from();
		}
		
		return $this->reply_to;
	}

	public function 
		set_reply_to($reply_to)
	{
		$this->reply_to = $reply_to;
	}

	public function 
		get_return_path()
	{
		if (!isset($this->return_path)) {
			$this->return_path = $this->get_from();
		}
		
		return $this->return_path;
	}

	public function 
		set_return_path($return_path)
	{
		$this->return_path = $return_path;
	}

	public function 
		get_cc()
	{
		return $this->cc;
	}

	public function 
		set_cc($cc)
	{
		$this->cc = $cc;
	}
	
	public function
		has_cc()
	{
		return isset($this->cc);
	}

	public function 
		get_bcc()
	{
		return $this->bcc;
	}

	public function 
		set_bcc($bcc)
	{
		$this->bcc = $bcc;
	}
	
	public function
		has_bcc()
	{
		return isset($this->bcc);
	}

	public function
		send()
	{
		$to = $this->get_to();
		$subject = $this->get_subject();
		$body = $this->get_body();
		$headers = $this->get_headers();
		
		mail(
			$to,
			$subject,
			$body,
			$headers
		);
	}
}
?>