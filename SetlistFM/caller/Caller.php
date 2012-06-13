<?php

abstract class SetlistFM_Caller {

	protected $cache;

	protected $apiKey;

	const API_URL = 'http://api.setlist.fm/rest/0.1/';
    
	public static function getInstance() {}

	public function call($method, array $params = array(), $requestMethod = 'GET'){
        $url = self::API_URL;
		$params = SetlistFM_Util::toUTF8($params);
        
        //replace items in the request method
        foreach($params as $key => $param) {
            if($param === null) {
                unset($params[$key]);
                continue;
            }
            
            if(strpos($method, '{'.$key.'}') !== false) {
                $method = str_replace('{'.$key.'}', $param, $method);
                unset($params[$key]);
            }
        }
        
		/* Call API */
		return $this->internalCall($url, $method, $params, $requestMethod);
	}
    
	protected abstract function internalCall($url, $method, $params, $requestMethod = 'GET');

	public function setApiKey($apiKey){
		$this->apiKey = $apiKey;
	}

	public function getApiKey(){
		return $this->apiKey;
	}

	public function setCache($cache){
		$this->cache = $cache;
	}

	public function getCache(){
		return $this->cache;
	}
}