<?php
/**
 * Payments_AbstractModuleDirectory
 *
 * @copyright Clear Line Web Design, 2007-10-04
 */

/**
 * This abstract class sets the requirements that implementing
 * plug-ins must meet.
 */
abstract class
	Payments_AbstractModuleDirectory
extends
    HaddockProjectOrganisation_AbstractPlugInModuleDirectory
{
	/**
	 * Should return a HTML tag object that is rendered as a button
	 * that takes the user to a payments page (e.g. at Paypal or Protx).
	 */
    abstract public function
        get_payment_button_tag();
}
?>
