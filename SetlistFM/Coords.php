<?php


class SetlistFM_Coords {
	
    private $lat;
    
    private $long;
    
	function __construct($lat, $long){
        $this->lat = $lat;
        $this->long = $long;
    }
    
    public function getLat() {
        return $this->lat;
    }

    public function getLong() {
        return $this->long;
    }
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){        
		return new SetlistFM_Coords(
			SetlistFM_Util::toString($xml->attributes()->lat),
            SetlistFM_Util::toString($xml->attributes()->long)
		);
	}
}