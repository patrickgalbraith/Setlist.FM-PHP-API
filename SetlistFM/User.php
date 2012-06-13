<?php


class SetlistFM_User {
	
    private $id;
    
    private $flickr;
    
    private $twitter;
    
    private $website;
    
    private $lastFm;
    
    private $mySpace;
    
    private $fullName;
    
    private $about;
    
    private $url;
    
    function __construct($id, $flickr, $twitter, $website, $lastFm, $mySpace, $fullName, $about, $url) {
        $this->id = $id;
        $this->flickr = $flickr;
        $this->twitter = $twitter;
        $this->website = $website;
        $this->lastFm = $lastFm;
        $this->mySpace = $mySpace;
        $this->fullName = $fullName;
        $this->about = $about;
        $this->url = $url;
    }
  
    public function getId() {
        return $this->id;
    }

    public function getFlickr() {
        return $this->flickr;
    }

    public function getTwitter() {
        return $this->twitter;
    }

    public function getWebsite() {
        return $this->website;
    }

    public function getLastFm() {
        return $this->lastFm;
    }

    public function getMySpace() {
        return $this->mySpace;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getAbout() {
        return $this->about;
    }

    public function getUrl() {
        return $this->url;
    }

    
    public static function getInfo($userId) {}
    
    public static function getSetlistsAttended($userId = null, $limit = 1, $lang = 'en') {}
    
    public static function getSetlistsEdited($userId = null, $limit = 1, $lang = 'en') {}
    
    
    public static function fromSimpleXMLElement(SimpleXMLElement $xml){        
		return new SetlistFM_User(
			SetlistFM_Util::toString($xml->attributes()->userId),
            SetlistFM_Util::toString($xml->attributes()->flickr),
            SetlistFM_Util::toString($xml->attributes()->twitter),
            SetlistFM_Util::toString($xml->attributes()->website),
            SetlistFM_Util::toString($xml->attributes()->lastFm),
            SetlistFM_Util::toString($xml->attributes()->mySpace),
            SetlistFM_Util::toString($xml->attributes()->fullname),
            SetlistFM_Util::toString($xml->about),
            SetlistFM_Util::toString($xml->url)
		);
	}
}