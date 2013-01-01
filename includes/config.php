<?php
function config(){
	$config['sabAddress'] = 'http://YOUR_SABNZBD_URL:YOUR_SABNZBD_PORT';
	$config['sabApiKey'] = 'YOUR_SABNZBD_NZB_APIKEY';
	$config['nzbsApiKey'] = 'YOUR_NZBSDOTORG_APIKEY';

	// Get categories from http://beta.nzbs.org/api?t=caps in the <categories> section

	$config['categories'] = array( 
		'Movies' => '2020',
		'TV Shows' => '5040',
		'PC' => '4020'
	);

	return $config;
}
?>
