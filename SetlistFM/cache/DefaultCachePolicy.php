<?php

final class SetlistFM_Cache_DefaultCachePolicy implements SetlistFM_Cache_CachePolicy {
    private static $MINUTE;
    private static $HOUR;
    private static $DAY;
    private static $WEEK;
    private static $MONTH;
    private static $THREEMONTH;
    private static $SIXMONTH;
    private static $YEAR;

    private $expirationOverrides;

    private $defaultExpiration;

    public function __construct(){
        self::$MINUTE      =                 60;
        self::$HOUR        = self::$MINUTE * 60;
        self::$DAY         = self::$HOUR   * 24;
        self::$WEEK        = self::$DAY    *  7;
        self::$MONTH       = self::$WEEK   *  4.34812141;
        self::$THREEMONTH  = self::$MONTH  *  3;
        self::$SIXMONTH    = self::$MONTH  *  6;
        self::$YEAR        = self::$MONTH  * 12;

        $this->expirationOverrides = array(
            'artist/{mbid}/setlists'      => self::$HOUR,
            'setlist/{setlistId}'         => self::$HOUR,
            'setlist/version/{versionId}' => self::$HOUR
        );

        $this->defaultExpiration = self::$WEEK;
    }

    public function getExpirationTime($method){
        if(array_key_exists($method, $this->expirationOverrides))
            return $this->expirationOverrides[$method];

        return $this->defaultExpiration;
    }

    public function getExpiration($method){
        return $this->expirationOverrides[$method];
    }

    public function setExpiration($method, $value){
        $this->expirationOverrides[$method] = $value;
    }
}