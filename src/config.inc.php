<?php
// UPUO 1.0B https://github.com/jake-cryptic/ultrapowa-user-overviews
$conf = (object) array(
	"meta" => (object) array(
		"DEBUG" => false,				// Show SQL errors or not
		"allowEdits" => false,				// Allow editing users from the site
		
		"site_name" => "Server Name", 			// Website/server name
		"server_ip" => "127.0.0.1", 			// Game Servers IP
		"server_port" => "9339", 			// Port to check for the server on
		"check_timeout" => (float)1.5, 			// Timeout when checking the server status(bigger the float, longer the load time)
		"default_lang" => "en", 			// The default language
		"charset" => "UTF-8", 				// The site's charset for each page
		"content_limit" => "20"				// This limits the amount of content to be shown from the database per page
	)
);

global $conf;
?>
