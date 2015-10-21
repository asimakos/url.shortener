
<?php

// Bit URL Web Service Consumption

class BitlyUrl{
  function __construct($url,$login,$appkey,$format='txt') {
  // Initialization of Web Service by passing to the Web Service several parameters
  // in order to get the expected result afterwards. In this Web service, the following parameters
  // are passed URL address to be shortened, username of the client, also API key of the client
  // and finally the format of results to be fetched (text format in this case), other formats
  // that could be used are json, xml etc
        $this->url=$url;
        $this->login=$login;
        $this->appkey=$appkey;
		$this->format=$format;

	}

  function get_bitly_short_url() {

    // pass the parameters to the Bitly Web Service adddress and get the shortener URL
    // from the Web Service

	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$this->login.'&apiKey='.$this->appkey.'&uri='.urlencode($this->url).'&format='.$this->format;
	return $this->curl_get_result($connectURL);
}

  function get_bitly_long_url($shorturl) {

   // pass the parameters to the Bitly Web Service (different address this time). In this case, we are using the shortened URL address
   //instead of the long URL in order to get the first one entered by the user.

	$connectURL = 'http://api.bit.ly/v3/expand?login='.$this->login.'&apiKey='.$this->appkey.'&shortUrl='.urlencode($shorturl).'&format='.$this->format;
	return $this->curl_get_result($connectURL);
}

  function curl_get_result($url) {
    // Consumption of Web Service via GET method. In case there would be an error, the necessary
    // check takes place.

	$curlObj = curl_init();

    $timeout = 5;
	curl_setopt($curlObj,CURLOPT_URL,$url);
	curl_setopt($curlObj,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curlObj,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($curlObj);

	curl_close($curlObj);
    return isset($data)? $data:false;
}

}



?>