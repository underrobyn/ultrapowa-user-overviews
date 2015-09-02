<?php
require("database.class.php");

$conf = (object) array(
	"meta" => (object) array(
		"site_name" => "ModClash-Main Test Server ", // Website/server name
		"server_ip" => "127.0.0.1", // Game Servers IP
		"server_port" => "9339", // Port to check for the server on
		"check_timeout" => "(float)1.5", // Timeout when checking the server status(bigger the float, longer the load time)
		"default_lang" => "en", // The default language
		"charset" => "UTF-16", // The site's charset for each page
		"content_limit" => "20"), // This limits the amount of content to be shown from the database per page
	"files" => (object) array (
		"libs" => (object) array( // Links to Libraries used in the website
			"bootstrap-css" => "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css", // Bootstrap CSS
			"bootstrap-js" => "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js", // Bootstrap JS
			"jquery" => "https://code.jquery.com/jquery-2.1.4.min.js") // JQuery
		)
	);
	
?>
