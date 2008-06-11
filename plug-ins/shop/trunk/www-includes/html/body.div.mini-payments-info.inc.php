<?php
/**
 * A mini-div that tells the customer information about the payments
 * options available at this shop.
 *
 * @copyright Clear Line Web Design, 2007-11-01
 */

$mini_payments_info_div = new HTMLTags_Div();
$mini_payments_info_div->set_attribute_str('id', 'mini_payments_info');

###############################################
## PAYPAL LOGO
###############################################
#$pay_pal_logo = <<<TXT
#<!-- PayPal Logo --><table class="paypal" border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr>
#<tr><td align="center"><a href="#" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img  src="https://www.paypal.com/en_US/i/bnr/vertical_solution_PPeCheck.gif" border="0" alt="Solution Graphics"></a></td></tr></table><!-- PayPal Logo -->
#TXT;
#
#$mini_payments_info_div->append_str_to_content($pay_pal_logo);
#
#$paypal_integration_text_1 = <<<TXT
#Connected Films Shop is integrated with PayPal for
#secure credit card payments.
#TXT;
#$paypal_integration_text_2 = <<<TXT
#You do not need a PayPal
#account to use our shop.
#TXT;
#$paypal_integration_text_1_p = new HTMLTags_P($paypal_integration_text_1);
#$paypal_integration_text_1_p->set_attribute_str('class', 'description');
#$mini_payments_info_div->append_tag_to_content($paypal_integration_text_1_p);
#
#$paypal_integration_text_2_p = new HTMLTags_P($paypal_integration_text_2);
#$paypal_integration_text_2_p->set_attribute_str('class', 'description');
#$mini_payments_info_div->append_tag_to_content($paypal_integration_text_2_p);

echo $mini_payments_info_div->get_as_string();
?>
