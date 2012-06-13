<?php


class SetlistFM_Artist {
	
    private $mbid;
    
    private $name;
    
    private $sortName;
    
    private $url;
    
    private $disambiguation;
    
	function __construct($mbid, $name, $sortName, $url, $disambiguation) {
        $this->mbid = $mbid;
        $this->name = $name;
        $this->sortName = $sortName;
        $this->url = $url;
        $this->disambiguation = $disambiguation;
    }

        
    public function getMbid() {
        return $this->mbid;
    }

    public function getName() {
        return $this->name;
    }

    public function getSortName() {
        return $this->sortName;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getDisambiguation() {
        return $this->disambiguation;
    }
    
    
    public static function getInfo($mbid) {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('artist/{mbid}.xml', array(
			'mbid' => $mbid
		));
        
        return SetlistFM_Artist::fromSimpleXMLElement($xml);
    }
    
    public static function getSetlists($mbid = null, $tourName = null, $page = 1, $lang = 'en') {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('artist/{mbid}/setlists.xml', array(
			'mbid' => $mbid,
            'tourName' => $tourName,
            'p' => $page,
            'l' => $lang
		));
        
        $setlists = array();
        
        foreach($xml->children() as $setlist) {
            $setlists[] = SetlistFM_Setlist::fromSimpleXMLElement($setlist);
        }
        
        return $setlists;
    }
    
    public static function search($artistName, $page = 1) {
        $xml = SetlistFM_Caller_CallerFactory::getDefaultCaller()->call('search/artists.xml', array(
			'artistName' => $artistName,
            'p' => $page,
		));
        
        $artists = array();
        
        foreach($xml->children() as $artist) {
            $artists[] = SetlistFM_Artist::fromSimpleXMLElement($artist);
        }
        
        return $artists;
    }
    
    
    /** Create an Artist object from a SimpleXMLElement object. */
	public static function fromSimpleXMLElement(SimpleXMLElement $xml){        
		return new SetlistFM_Artist(
			SetlistFM_Util::toString($xml->attributes()->mbid),
			SetlistFM_Util::toString($xml->attributes()->name),
            SetlistFM_Util::toString($xml->attributes()->sortName),
            SetlistFM_Util::toString($xml->url),
			SetlistFM_Util::toString($xml->attributes()->disambiguation)
		);
	}
}