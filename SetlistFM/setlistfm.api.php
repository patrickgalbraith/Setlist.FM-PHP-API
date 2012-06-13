<?php

/** Autoloads PHP setlist.fm API classes
 *
 * @package	php-setlistfm-api
 * @author  P Galbraith
 * @version	1.0
 */

function setlistfm_autoload($name){
    if(stripos($name, 'SetlistFM_') === false)
        return false;
    
    if($name == 'SetlistFM_Cache')
        $filename = realpath(sprintf("%s/cache/%s.php", dirname(__FILE__), 'Cache'));
    else if(stripos($name, 'SetlistFM_Cache_') !== false)
		$filename = realpath(sprintf("%s/cache/%s.php", dirname(__FILE__), str_replace('SetlistFM_Cache_', '', $name)));
    else if($name == 'SetlistFM_Caller')
        $filename = realpath(sprintf("%s/caller/%s.php", dirname(__FILE__), 'Caller'));
	else if(stripos($name, 'SetlistFM_Caller_') !== false)
		$filename = realpath(sprintf("%s/caller/%s.php", dirname(__FILE__), str_replace('SetlistFM_Caller_', '', $name)));
	else 
		$filename = realpath(sprintf("%s/%s.php", dirname(__FILE__), str_replace('SetlistFM_', '', $name)));

	if(!file_exists($filename))
        return false;
    
    require_once $filename;
}

spl_autoload_register('setlistfm_autoload');