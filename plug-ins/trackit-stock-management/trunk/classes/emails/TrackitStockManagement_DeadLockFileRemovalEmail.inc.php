<?php
/**
 * TrackitStockManagement_DeadLockFileRemovalEmail
 *
 * @copyright 2008-05-08, RFI
 */

class
	TrackitStockManagement_DeadLockFileRemovalEmail
extends
	TrackitStockManagement_Email
{
	public function
		__construct(
			CLIScripts_LockFile $lock_file
		)
	{
		parent::__construct();
		
		$tism_cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
		
		#$email_to = 'invitations@play4ateam.com';
		#$email_to = 'robert@clearlinewebdesign.com';
		
		$email_to = $tism_cm->get_dlfre_to();
		
		$this->set_to($email_to);
		
		#$subject_template = "Lock file removed";
		$subject_template = $tism_cm->get_dlfre_subject_template();
		
		$this
			->set_subject_template($subject_template);
			
		$this->add_template_variable(
			'process_id',
			$lock_file->get_process_id()
		);
		
		$this->add_template_variable(
			'lock_file_ctime',
			date(
				'c',
			#	strtotime(
					$lock_file->ctime()
			#	)
			)
		);
		
		$this->add_template_variable(
			'current_time',
			date('c')
		);
		
		$this->add_template_variable(
			'lock_file_name',
			$lock_file->get_name()
		);
		
		$this->add_template_variable(
			'hostname',
			Environment_MachineHelper::get_real_host_name()
		);
		
#		$body_template = 
#'A dead lock file called:
#
#${lock_file_name}
#
#on
#
#${hostname}
#
#which had been created at:
#
#${lock_file_ctime}
#
#was removed at
#
#${current_time}
#
#The lock file had been for the process with PID:
#
#${process_id}
#
#';

		$body_template = $tism_cm->get_dlfre_body_template();
		
		$this
			->set_body_template(
				$body_template
			);
		
		#$from_address = 'robert@clearlinewebdesign.com';
		#$from_address = get_current_user() . '@' . $_ENV['HOSTNAME'];
		#
		#$this->set_from($from_address);
		
		#echo 'print_r($this):' . "\n";
		#print_r($this);
	}
}
?>