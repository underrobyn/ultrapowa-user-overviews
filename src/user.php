<?php
if (empty($_GET["id"])) {
	header("Location: index.php");
	die("<a href='index.php'>If not redirected click here</a>");
} else {
	if (is_numeric($_GET["id"])) {
		$setId = strip_tags($_GET["id"]);
	
		require_once("config.inc.php");
		
		$dbc = new databaseConnection();
		$dbc->connect();
		
		$sql = "SELECT * FROM player WHERE PlayerId = '" . $setId . "'";
	} else {
		header("Location: index.php");
		die("<a href='index.php'>If not redirected click here</a>");
	}
}
?>
<!DOCTYPE HTML>
<html lang="<?php echo $conf->meta->default_lang; ?>">
	<head>
	
		<title><?php echo $conf->meta->site_name; ?></title>
		<meta charset="<?php echo $conf->meta->charset; ?>">
		<meta name="viewport" content="width=device-width, maximum-scale=1">
		
		<!-- Some CSS -->
		<style type="text/css">
		#container { margin: 0 1.5% 0 1.5%; }
		h3, p { text-align:center; }
		.border-bottom { border-bottom:1px solid black; }
		@media screen and (max-width:1024px) {
			h1 {
				font-size:1.2em;
			}
		}
		</style>
		
		<!-- Bootstrap and JQuery -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
	</head>
	<body>
	
		<div id="container">
		
			<div class="row border-bottom">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1><?php echo $conf->meta->site_name . " - Edit PlayerId: " . $setId; ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<?php
					if (!$dbc->queryDB($sql)) {
						echo $dbc->errors()."<br />";
					} else {
						$databaseResponse = $dbc->queryDB($sql);
						while($row = mysqli_fetch_array($databaseResponse)){
							echo "<h3>Avatar</h3><textarea id=\"avatar\" rows=\"10\" cols=\"70\">" . $row["Avatar"] . "</textarea>";
					?>
				</div>
				<div class="col-md-4">
					<?php
							echo "<h3>Meta</h3><p>Last Update Time: " . $row["LastUpdateTime"] . "<br /><br />Account Privilege Level<br /><input type=\"text\" name=\"AccountPrivileges\" value=\"" . $row["AccountPrivileges"] ."\"></p>";
					?>
				</div>
				<div class="col-md-4">
					<?php
							echo "<h3>GameObjects</h3><textarea id=\"GameObjects\" rows=\"10\" cols=\"70\">" . $row["GameObjects"] . "</textarea>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
<?php echo $dbc->errors(); $dbc->disconnect(); ?>
