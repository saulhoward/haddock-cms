<?php
/**
 * The main .INC for the list-payment-plug-ins script.
 *
 * @copyright Clear Line Web Design, 2007-10-04
 */

$obf = Payments_OptionButtonsFactory::get_instance();

$payment_plug_ins = $obf->get_payment_plug_ins();

echo "The installed payment plug-ins: \n\n";

foreach ($payment_plug_ins as $ppi) {
    echo $ppi->get_identifying_name() . "\n";
}

#CLIScripts_InputReader::confirm_continue('exit')
?>
