<?php
// UPUO 1.0B https://github.com/jake-cryptic/ultrapowa-user-overviews
require("config.inc.php");

if ($conf->meta->allowEdits != true) {
	die("<h1>The site configuration prevents user editing</h1>");
}
echo "<h1>Editing not yet implemented</h1>";
print_r($_POST);
?>
