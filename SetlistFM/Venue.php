<?php


class SetlistFM_Venue {
	
    private $id;
    
    private $name;
    
    private $url;
    
    private $city;
    
    function __construct($id, $name, $city, $url) {
        $this->id = $id;
        $this->name = $name;
        $this->city = $city;
        $this->url = $url;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getCity() {
        return $this->city;
    } 
    
    
    public static function getInfo($venueId, $lang = 'en') {}
    
    public static function getSetlists($venueId = null, $limit = 1, $lang = 'en') {}
    
    public static function search(array $operators, $limit = 1, $lang = 'en') {}
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){        
		return new SetlistFM_Venue(
			SetlistFM_Util::toString($xml->attributes()->id),
            SetlistFM_Util::toString($xml->attributes()->name),
            SetlistFM_City::fromSimpleXMLElement($xml->city),
            SetlistFM_Util::toString($xml->attributes()->url)
		);
	}
}