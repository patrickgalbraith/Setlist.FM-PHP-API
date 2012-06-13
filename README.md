PHP Setlist.fm API Documentation
================================

The PHP Setlist.fm API library provides simple OOP method for accessing data via the Setlist.fm API. Responses can be cached on the filesystem or in a database.


Usage
-----

    //Set up setlistFM api
    require_once APPPATH.'libraries/SetlistFM/setlistfm.api.php';
	
	//Get Setlist ID
    $setlist = SetlistFM_Setlist::getInfo('setlist_id');
	
	//Get Setlist by LastFM Event ID
    $setlist = SetlistFM_Setlist::getInfoByLastFmEventId('lastfm_event_id');
	
	//Search for setlist by MBID
	$setlist = SetlistFM_Setlist::search(array('artistMbid' => 'some_artist_mbid', 'date' => date("d-m-Y", 'some_date')));

	
Credit
------

Inspired by Last.FM PHP API created by Felix Bruns


More
----

For further information, please visit the official API documentation: 
http://api.setlist.fm
