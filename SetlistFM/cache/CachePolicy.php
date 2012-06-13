<?php

interface SetlistFM_Cache_CachePolicy {
	public function getExpirationTime($method);
}