
<?php

// Tiny URL Web Service Consumption

class TinyUrl{
  // Initialization of Web service by setting the client (in this case browser) for
  // consumption to the appropriate Web Service address

  function __construct($apiURL = 'http://tinyurl.com/api-create.php?url=') {

		$this->apiURL = $apiURL;
	}

  function get_tiny_url($url)  {
    // Pass the appropriate parameter url address to be shortened and get the
    // result back of the Web service. In case there would be an error, the
    // necessary check takes place.

	$curlObj = curl_init();
	$timeout = 5;
	curl_setopt($curlObj,CURLOPT_URL,$this->apiURL.$url);
	curl_setopt($curlObj,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curlObj,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($curlObj);

	curl_close($curlObj);
	return isset($data)? $data:false;

}

}

?>