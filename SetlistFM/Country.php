<?php


class SetlistFM_Country {
    
    private $name;
    
    private $code;
    
    function __construct($name, $code) {
        $this->name = $name;
        $this->code = $code;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getCode() {
        return $this->code;
    }
    
    
    public static function getCountries($lang = 'en') {}
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){        
		return new SetlistFM_Country(
			SetlistFM_Util::toString($xml->attributes()->name),
            SetlistFM_Util::toString($xml->attributes()->code)
		);
	}
}