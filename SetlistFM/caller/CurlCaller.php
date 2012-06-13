<?php

final class SetlistFM_Caller_CurlCaller extends SetlistFM_Caller {

	private static $instance;

	private $curl;

	private $headers;

	private function __construct(){
		$this->curl  = curl_init();

		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->curl, CURLOPT_USERAGENT, "PHP setlist.fm API (PHP/" . phpversion() . ")");
		//curl_setopt($this->curl, CURLOPT_HEADERFUNCTION, array(&$this, 'header'));
        //curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Expect:'));

	}

	public function __destruct(){
		curl_close($this->curl);
	}

	public static function getInstance(){
		if(!is_object(self::$instance)){
			self::$instance = new SetlistFM_Caller_CurlCaller();
		}

		return self::$instance;
	}

	protected function internalCall($url, $method, $params, $requestMethod = 'GET'){
		/* Create caching hash. */
		$hash = SetlistFM_Cache::createHash(
                array_merge(
                            array('method' => $method), 
                            $params
                           ));

		/* Check if response is cached. */
		if($this->cache != null && $this->cache->contains($hash) && !$this->cache->isExpired($hash)){
			/* Get cached response. */
			$response = $this->cache->load($hash);
		}
		else{
            
			/* Build request query */
			$query = http_build_query($params, '', '&');

			/* Set request options. */
			if($requestMethod === 'POST'){
				curl_setopt($this->curl, CURLOPT_URL, trim($url.$method));
				curl_setopt($this->curl, CURLOPT_POST, 1);
				curl_setopt($this->curl, CURLOPT_POSTFIELDS, $query);
			}
			else {
				curl_setopt($this->curl, CURLOPT_URL, trim($url.$method.'?'.$query));
				curl_setopt($this->curl, CURLOPT_POST, 0);
			}

			/* Clear response headers. */
			$this->headers = array();

			/* Get response. */
			$response = curl_exec($this->curl);
            
            if($response === false) {
                throw new SetlistFM_Error(
                    curl_error($this->curl)
                );
            }
            
            if(empty($response)) {
                throw new SetlistFM_Error(
                    "Request returned empty response. Url: \"".$url.$method.'?'.$query."\" | Curl Error No: ".curl_errno($this->curl)." | CURL_INFO: ".print_r(curl_getinfo($this->curl), true)
                );
            }
            
			/* Cache it. */
			if($this->cache != null){
				if(array_key_exists('Expires', $this->headers)){
					$this->cache->store(
						$hash, $response,
						strtotime($this->headers['Expires'])
					);
				}
				else{
					$expiration = $this->cache->getPolicy()->getExpirationTime($method);
                    
					if($expiration > 0){
						$this->cache->store($hash, $response, time() + $expiration);
					}
				}
			}
		}
        
		/* Create SimpleXMLElement from response. */
        $prev_libxml = libxml_use_internal_errors(true);
		$result = new SimpleXMLElement($response);
        libxml_use_internal_errors($prev_libxml);
        
        return $result;
	}

	private function header($cURL, $header){
		$parts = explode(': ', $header, 2);

		if(count($parts) == 2){
			list($key, $value) = $parts;

			$this->headers[$key] = trim($value);
		}

		return strlen($header);
	}
}


