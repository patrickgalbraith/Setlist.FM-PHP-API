<?php


class SetlistFM_Set {
	
    private $name;
    
    private $encore;
    
    private $songs;
    
	function __construct($name, $songs, $encore) {
        $this->name = $name;
        $this->encore = $encore;
        $this->songs = $songs;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getSongs() {
        return $this->songs;
    }
    
    public function getEncore() {
        return $this->encore;
    }
    
    public function isEncore() {
        return ($this->encore === null ? false : true);
    }
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){
        
        $songs = array();
        
        $count = 1;
        foreach($xml->children() as $song) {
            $songs[] = SetlistFM_Song::fromSimpleXMLElement($song, $count);
            $count++;
        }
        
		return new SetlistFM_Set(
			SetlistFM_Util::toString($xml->attributes()->name),
			$songs,
            SetlistFM_Util::toString($xml->attributes()->encore)
		);
	}
}