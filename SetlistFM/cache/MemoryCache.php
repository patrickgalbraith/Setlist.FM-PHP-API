<?php

final class SetlistFM_Cache_MemoryCache extends SetlistFM_Cache {

	private $cache;

	public function __construct(){
		parent::__construct();

		$this->cache = array();
	}

	public function contains($hash){
		return array_key_exists($hash, $this->cache);
	}

	public function load($hash){
		return $this->cache[$hash]['data'];
	}

	public function remove($hash){
		unset($this->cache[$hash]);
	}

	public function store($hash, $data, $expiration){
		$this->cache[$hash] = array(
			'data'       => $data,
			'expiration' => $expiration
		);
	}

	public function clear(){
		$this->cache = array();
	}

	public function isExpired($hash){
		$expiration = $this->cache[$hash]['expiration'];

		return (time() > intval($expiration));
	}
}