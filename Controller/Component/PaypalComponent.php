<?php
/**
* Paypal Direct Payment API Component class file.
*/
class PaypalComponent extends Component {

	function processPayment($paymentInfo,$function){
		if ($function=="DoDirectPayment")
			return $this->DoDirectPayment($paymentInfo);
		elseif ($function=="SetExpressCheckout")
			return $this->SetExpressCheckout($paymentInfo);
		elseif ($function=="GetExpressCheckoutDetails")
			return $this->GetExpressCheckoutDetails($paymentInfo);
		elseif ($function=="DoExpressCheckoutPayment")
			return $this->DoExpressCheckoutPayment($paymentInfo);
		else
			return "Function Does Not Exist!";
	}

	function __construct(){

	}

	function DoDirectPayment($paymentInfo=array()) {
		/**
		* Get required parameters from the web form for the request
		*/
		$firstName =urlencode($paymentInfo['FIRSTNAME']);
		$lastName =urlencode($paymentInfo['LASTNAME']);
		$creditCardType =urlencode($paymentInfo['CARDTYPE']);
		$creditCardNumber = urlencode($paymentInfo['CARDNUMBER']);
		$expDateMonth =urlencode($paymentInfo['EXPMONTH']);
		$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
		$expDateYear =urlencode($paymentInfo['EXPYEAR']);
		$cvv2Number = urlencode($paymentInfo['CARDCODE']);
		$address1 = urlencode($paymentInfo['ADDRESS']);
		$address2 = urlencode('');
		$country = urlencode($paymentInfo['COUNTRY']);
		$city = urlencode($paymentInfo['CITY']);
		$state =urlencode($paymentInfo['STATE']);
		$zip = urlencode($paymentInfo['ZIP']);
		$amount = urlencode($paymentInfo['AMOUNT']);
		$invoiceid = urlencode($paymentInfo['INVOICEID']);
		$email = urlencode($paymentInfo['EMAIL']);
		$currencyCode="USD";
		$paymentType=urlencode('Sale');
		$ip=$_SERVER['REMOTE_ADDR'];

		/* Construct the request string that will be sent to PayPal.
		The variable $nvpstr contains all the variables and is a
		name value pair string with & as a delimiter */
		$nvpstr="&PAYMENTACTION=Sale&IPADDRESS=$ip&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&STREET2=$address2&CITY=$city&STATE=$state".
		"&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyCode&EMAIL=$email&INVNUM=$invoiceid"; 

		/* Make the API call to PayPal, using API signature.
		The API response is stored in an associative array called $resArray */
		$resArray=$this->hash_call("doDirectPayment",$nvpstr);

		/* Display the API response back to the browser.
		If the response from PayPal was a success, display the response parameters'
		If the response was an error, display the errors received using APIError.php.
		*/
		return $resArray;
		//Contains 'TRANSACTIONID,AMT,AVSCODE,CVV2MATCH, Or Error Codes'
	}

	function SetExpressCheckout($paymentInfo=array()){
		$amount = urlencode($paymentInfo['Order']['theTotal']);
		$paymentType=urlencode('Sale');
		$currencyCode=urlencode('USD');
		$returnURL =urlencode($paymentInfo['Order']['returnUrl']);
		$cancelURL =urlencode($paymentInfo['Order']['cancelUrl']);
		$nvpstr='&AMT='.$amount.'&PAYMENTACTION='.$paymentType.'&CURRENCYCODE='.$currencyCode.'&RETURNURL='.$returnURL.'&CANCELURL='.$cancelURL;
		$resArray=$this->hash_call("SetExpressCheckout",$nvpstr);
		return $resArray;
	}

	function GetExpressCheckoutDetails($token){
		$nvpstr='&TOKEN='.$token;
		$resArray=$this->hash_call("GetExpressCheckoutDetails",$nvpstr);
		return $resArray;
	}

	function DoExpressCheckoutPayment($paymentInfo=array()){
		$paymentType='Sale';
		$currencyCode='USD';
		$serverName = $_SERVER['SERVER_NAME'];
		$nvpstr='&TOKEN='.urlencode($paymentInfo['TOKEN']).'&PAYERID='.urlencode($paymentInfo['PAYERID']).'&PAYMENTACTION='.urlencode($paymentType).'&AMT='.urlencode($paymentInfo['ORDERTOTAL']).'&CURRENCYCODE='.urlencode($currencyCode).'&IPADDRESS='.urlencode($serverName);
		$resArray=$this->hash_call("DoExpressCheckoutPayment",$nvpstr);
		return $resArray;
	}

	function APIError($errorNo,$errorMsg,$resArray){
		$resArray['Error']['Number']=$errorNo;
		$resArray['Error']['Number']=$errorMsg;
		return $resArray;
	}

	function hash_call($methodName,$nvpStr) {
	//require_once 'constants.php';
		$API_UserName=API_USERNAME;
		$API_Password=API_PASSWORD;
		$API_Signature=API_SIGNATURE;
		$API_Endpoint =API_ENDPOINT;
		$version=VERSION;

		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
		//Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 

		if(USE_PROXY) {
			curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT);
		}

		//NVPRequest for submitting to server
		$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($version)."&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature).$nvpStr;

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);

		//getting response from server
		$response = curl_exec($ch);
		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);

		if (curl_errno($ch))
			$nvpResArray = $this->APIError(curl_errno($ch),curl_error($ch),$nvpResArray);
		else 
			curl_close($ch);
		return $nvpResArray;
	}

	/** This function will take NVPString and convert it to an Associative Array and it will decode the response.
	* It is usefull to search for a particular key and displaying arrays.
	* @nvpstr is NVPString.
	* @nvpArray is Associative Array.
	*/

	function deformatNVP($nvpstr) {
		$intial=0;
		$nvpArray = array();

		while(strlen($nvpstr)){
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		}
		return $nvpArray;
	}
}
?>