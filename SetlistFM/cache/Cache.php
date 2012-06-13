<?php

abstract class SetlistFM_Cache {

	private $policy;

	protected function __construct(){
		$this->policy = new SetlistFM_Cache_DefaultCachePolicy();
	}

	public function getPolicy(){
		return $this->policy;
	}

	public function setPolicy(SetlistFM_Cache_CachePolicy $policy){
		$this->policy = $policy;
	}

	public abstract function contains($hash);

	public abstract function load($hash);

	public abstract function remove($hash);

	public abstract function store($hash, $data, $expiration);

	public abstract function isExpired($hash);

	public abstract function clear();

	public static function createHash($params){
		$string = '';

		sort($params);

		foreach($params as $param => $value){
			$string .= $param.$value;
		}

		return sha1($string);
	}
}


