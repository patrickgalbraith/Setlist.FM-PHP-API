<?php


class SetlistFM_Setlist {
	
    private $id;
    
    private $eventDate;
    
    private $versionId;
    
    private $tour;
    
    private $lastFmEventId;
    
    private $artist;
    
    private $venue;
    
    private $sets;
    
    private $info;
    
    private $url;
    
	function __construct($id, $eventDate, $versionId, $tour, $lastFmEventId, $artist, $venue, $sets, $info, $url) {
        $this->id = $id;
        $this->eventDate = $eventDate;
        $this->versionId = $versionId;
        $this->tour = $tour;
        $this->lastFmEventId = $lastFmEventId;
        $this->artist = $artist;
        $this->venue = $venue;
        $this->sets = $sets;
        $this->info = $info;
        $this->url = $url;
    }
  
    public function getId() {
        return $this->id;
    }

    public function getEventDate() {
        return $this->eventDate;
    }

    public function getVersionId() {
        return $this->versionId;
    }

    public function getTour() {
        return $this->tour;
    }

    public function getLastFmEventId() {
        return $this->lastFmEventId;
    }
    
    public function getArtist() {
        return $this->artist;
    }

    public function getVenue() {
        return $this->venue;
    }

    public function getSets() {
        return $this->sets;
    }

    public function getUrl() {
        return $this->url;
    }

    
    
    public static function getInfo($setlistId, $lang = 'en') {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('setlist/{setlistId}.xml', array(
			'setlistId' => $setlistId,
            'l' => $lang
		));
        
        return SetlistFM_Setlist::fromSimpleXMLElement($xml);
    }
    
    public static function getInfoByLastFmEventId($lastFmEventId, $lang = 'en') {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('setlist/lastFm/{lastFmEventId}.xml', array(
			'lastFmEventId' => $lastFmEventId,
            'l' => $lang
		));
        
        return SetlistFM_Setlist::fromSimpleXMLElement($xml);
    }
    
    public static function getInfoByVersionId($versionId, $lang = 'en') {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('setlist/version/{versionId}.xml', array(
			'versionId' => $versionId,
            'l' => $lang
		));
        
        return SetlistFM_Setlist::fromSimpleXMLElement($xml);
    }
    
    public static function search(array $operators) {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('search/setlists.xml', $operators);
        
        $setlists = array();
        
        foreach($xml->children() as $setlist) {
            $setlists[] = SetlistFM_Setlist::fromSimpleXMLElement($setlist);
        }
        
        return $setlists;
    }
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){
		
        $sets = array();
        foreach($xml->sets->children() as $set) {
            $sets[] = SetlistFM_Set::fromSimpleXMLElement($set);
        }
        
		return new SetlistFM_Setlist(
			SetlistFM_Util::toString($xml->attributes()->id),
			SetlistFM_Util::toString($xml->attributes()->eventDate),
            SetlistFM_Util::toString($xml->attributes()->versionId),
            SetlistFM_Util::toString($xml->attributes()->tour),
			SetlistFM_Util::toString($xml->attributes()->lastFmEventId),
            SetlistFM_Artist::fromSimpleXMLElement($xml->artist),
            SetlistFM_Venue::fromSimpleXMLElement($xml->venue),
            $sets,
            SetlistFM_Util::toString($xml->info),
            SetlistFM_Util::toString($xml->url)
		);
	}
}