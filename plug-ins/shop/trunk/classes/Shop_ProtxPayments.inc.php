<?php
/**
 * Shop_ProtxPayments
 *
 * @copyright Clear Line Web Design, 2007-09-18
 */

class
Shop_ProtxPayments
{
	//        private $amount;
	//        private $currency_row;

	//        public function
	//                __construct($amount, Shop_CurrencyRow $currency_row)
	//        {
	//                $this->amount = $amount;
	//                $this->currency_row = $currency_row;
	//        }

	/* Base 64 Encoding function **
	 ** PHP does it natively but just for consistency and ease of maintenance, let's declare our own function **/

	public function base64Encode($plain) {
		// Initialise output variable
		$output = "";

		// Do encoding
		$output = base64_encode($plain);

		// Return the result
		return $output;
	}

	/* Base 64 decoding function **
	 ** PHP does it natively but just for consistency and ease of maintenance, let's declare our own function **/

	public function base64Decode($scrambled) {
		// Initialise output variable
		$output = "";

		// Fix plus to space conversion issue
		$scrambled = str_replace(" ","+",$scrambled);

		// Do encoding
		$output = base64_decode($scrambled);

		// Return the result
		return $output;
	}


	/*  The SimpleXor encryption algorithm                                                                                **
	 **  NOTE: This is a placeholder really.  Future releases of VSP Form will use AES or TwoFish.  Proper encryption      **
	 **  This simple function and the Base64 will deter script kiddies and prevent the "View Source" type tampering        **
	 **  It won't stop a half decent hacker though, but the most they could do is change the amount field to something     **
	 **  else, so provided the vendor checks the reports and compares amounts, there is no harm done.  It's still          **
	 **  more secure than the other PSPs who don't both encrypting their forms at all                                      */

	public function simpleXor($InString, $Key) 
	{
		// Initialise key array
		$KeyList = array();
		// Initialise out variable
		$output = "";

		// Convert $Key into array of ASCII values
		for($i = 0; $i < strlen($Key); $i++){
			$KeyList[$i] = ord(substr($Key, $i, 1));
		}

		// Step through string a character at a time
		for($i = 0; $i < strlen($InString); $i++) {
			// Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
			// % is MOD (modulus), ^ is XOR
			$output.= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
		}

		// Return the result
		return $output;
	}

	function getToken($thisString) {

		// List the possible tokens
		$Tokens = array(
			"Status",
			"StatusDetail",
			"VendorTxCode",
			"VPSTxId",
			"TxAuthNo",
			"Amount",
			"AVSCV2", 
			"AddressResult", 
			"PostCodeResult", 
			"CV2Result", 
			"GiftAid", 
			"3DSecureStatus", 
			"CAVV" );

		// Initialise arrays
		$output = array();
		$resultArray = array();

		// Get the next token in the sequence
		for ($i = count($Tokens)-1; $i >= 0 ; $i--){
			// Find the position in the string
			$start = strpos($thisString, $Tokens[$i]);
			// If it's present
			if ($start !== false){
				// Record position and token name
				$resultArray[$i]->start = $start;
				$resultArray[$i]->token = $Tokens[$i];
			}
		}

		// Sort in order of position
		sort($resultArray);
		// Go through the result array, getting the token values
		for ($i = 0; $i<count($resultArray); $i++){
			// Get the start point of the value
			$valueStart = $resultArray[$i]->start + strlen($resultArray[$i]->token) + 1;
			// Get the length of the value
			if ($i==(count($resultArray)-1)) {
				$output[$resultArray[$i]->token] = substr($thisString, $valueStart);
			} else {
				$valueLength = $resultArray[$i+1]->start - $resultArray[$i]->start - strlen($resultArray[$i]->token) - 2;
				$output[$resultArray[$i]->token] = substr($thisString, $valueStart, $valueLength);
			}      

		}

		// Return the ouput array
		return $output;
	}


}
?>
