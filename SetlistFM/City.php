<?php


class SetlistFM_City {
	
    private $id;
    
    private $name;
    
    private $state;
    
    private $stateCode;
    
    private $coords;
    
    private $country;
    
    function __construct($id, $name, $state, $stateCode, $coords, $country) {
        $this->id = $id;
        $this->name = $name;
        $this->state = $state;
        $this->stateCode = $stateCode;
        $this->coords = $coords;
        $this->country = $country;
    }

    
    public function getId() {
        return $this->id;
    }
    
    public function getGeoId() {
        return $this->geoId;
    }

    public function getName() {
        return $this->name;
    }

    public function getState() {
        return $this->state;
    }

    public function getStateCode() {
        return $this->stateCode;
    }

    public function getCoords() {
        return $this->coords;
    }

    public function getCountry() {
        return $this->country;
    }
    
    
    public static function getInfo($geoId, $lang = 'en') {}
    
    public static function search(array $operators, $page = 1, $lang = 'en') {}
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){        
		return new SetlistFM_City(
			SetlistFM_Util::toString($xml->attributes()->id),
            SetlistFM_Util::toString($xml->attributes()->name),
            SetlistFM_Util::toString($xml->attributes()->state),
            SetlistFM_Util::toString($xml->attributes()->stateCode),
            SetlistFM_Coords::fromSimpleXMLElement($xml->coords),
            SetlistFM_Country::fromSimpleXMLElement($xml->country)
		);
	}
}