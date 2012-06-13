<?php


class SetlistFM_Song {
	
    private $name;
    
    private $with; //artist
    
    private $cover; //artist
    
    private $info;
    
    private $position;
    
    function __construct($name, $with, $cover, $info, $position = 0) {
        $this->name = $name;
        $this->with = $with;
        $this->cover = $cover;
        $this->info = $info;
        $this->position = $position;
    }

    
    public function getName() {
        return $this->name;
    }

    public function getWith() {
        return $this->with;
    }

    public function getCover() {
        return $this->cover;
    }

    public function getInfo() {
        return $this->info;
    }
    
    public function getPosition() {
        return $this->position;
    }
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml, $position = 0){
		return new SetlistFM_Song(
			SetlistFM_Util::toString($xml->attributes()->name),
			isset($xml->with) ? SetlistFM_Artist::fromSimpleXMLElement($xml->with) : null,
            isset($xml->cover) ? SetlistFM_Artist::fromSimpleXMLElement($xml->cover) : null,
            isset($xml->info) ? SetlistFM_Util::toString($xml->info) : null,
            $position
		);
	}
}