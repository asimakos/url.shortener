
<?php

 //Google URL Web Service consumption

class GoogleUrl{

	function __construct($key,$apiURL = 'https://www.googleapis.com/urlshortener/v1/url') {

    // Initialization of Web service by setting the client (in this case browser) for consumption
    // to the appropriate Web service address and passing the Web service API key during registration

		$this->apiURL = $apiURL.'?key='.$key;
	}


	function shorten($url) {

    // pass the URL parameter to the Google URL Web Service for consumption and
    // get the shortener URL back. In case there would be an error, the necessary
    // check takes place.

		$response = $this->send($url);
		return isset($response->id) ? $response->id : false;
	}


	function expand($url) {

    // pass the URL parameter to the Google URL Web service (different address in this time).
    // In this case, we are using the shortened URL address instead of the long URL
    // in order to get the first one entered by the user. In case there would be an error,
    // the necessary check takes place.

		$response = $this->send($url,false);
        return isset($response->longUrl) ? $response->longUrl : false;
	}


	function send($url,$shorten = true) {

    // Consumption of Web service via GET method (get the long URL)
    //  ELSE part and consumption of Web service via POST
    // method (get the short URL) IF part

		$postData = array('longUrl' => $url, 'key' => $this->apiURL);
        $jsonData = json_encode($postData);

		$curlObj = curl_init();

		if($shorten) {
			curl_setopt($curlObj, CURLOPT_URL, $this->apiURL);
            curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlObj, CURLOPT_HEADER, 0);
            curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
            curl_setopt($curlObj, CURLOPT_POST, 1);
            curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

		}
		else {
            curl_setopt($curlObj, CURLOPT_URL, $this->apiURL.'&shortUrl='.$url);
            curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlObj, CURLOPT_HEADER, 0);
            curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));

		}


		$result = curl_exec($curlObj);


		return json_decode($result);

        curl_close($curlObj);
	}
}


?>