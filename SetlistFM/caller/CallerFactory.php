<?php

class SetlistFM_Caller_CallerFactory {

	private static $default = 'CurlCaller';

	public static function getCurlCaller(){
		return SetlistFM_Caller_CurlCaller::getInstance();
	}

	public static function getDefaultCaller(){
		/* > PHP 5.3.0
		return self::$default::getInstance();
		*/
		$function = 'get'.self::$default;

		return self::$function();
	}

	public function setDefaultCaller($class){
		if(get_parent_class($class) == 'SetlistFM_Caller'){
			self::$default = $class;
		}
		else{
			throw new Exception("Class '".$class."' does not extend 'SetlistFM_Caller'!");
		}
	}
}


