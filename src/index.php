<?php
require_once("config.inc.php");

if ($isOnline = @fsockopen($conf->meta->server_,$conf->meta->server_port,$errno,$errstr,$conf->meta->check_timeout)) {
	fclose($isOnline);
	$serverStatus = '<span style="color:green; font-weight: bold;">Online</span>';
} else {
	$serverStatus = '<span style="color:red; font-weight: bold;">Offline</span>';
}

$dbc = new databaseConnection();
$dbc->connect();

if (empty($_GET["page"])) {
	$currentPage = 0;
	$currentPageLimit = 0;
} else {
	if (!is_numeric($_GET["page"])) {
		$currentPage = 0;
		$currentPageLimit = 0;
	} else {
		$currentPage = strip_tags($_GET["page"]);
		$currentPageLimit = $conf->meta->content_limit*$currentPage;
	}
}

if (empty($_GET["sortBy"])) {
	$sql = "SELECT * FROM player LIMIT $currentPageLimit,".$conf->meta->content_limit;
} else {
	$sortBy = htmlentities($_GET["sortBy"]);
	switch ($sortBy) {
		case "id_asc":
			$sql = "SELECT * FROM player ORDER BY `PlayerId` ASC LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
		case "id_desc":
			$sql = "SELECT * FROM player ORDER BY `PlayerId` DESC LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
		case "pl_asc":
			$sql = "SELECT * FROM player ORDER BY `AccountPrivileges` ASC LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
		case "pl_desc":
			$sql = "SELECT * FROM player ORDER BY `AccountPrivileges` DESC LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
		case "ut_asc":
			$sql = "SELECT * FROM player ORDER BY `LastUpdateTime` ASC LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
		case "ut_desc":
			$sql = "SELECT * FROM player ORDER BY `LastUpdateTime` DESC LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
		default:
			$sql = "SELECT * FROM player LIMIT $currentPageLimit,".$conf->meta->content_limit;
			break;
	}
}

?>
<!DOCTYPE HTML>
<html lang="<?php echo $conf->meta->default_lang; ?>">
	<head>
	
		<title><?php echo $conf->meta->site_name; ?></title>
		<meta charset="<?php echo $conf->meta->charset; ?>">
		<meta name="viewport" content="width=device-width, maximum-scale=1">
		
		<style>
		body { width:98%; margin: 0% .5% 0% 1.5%; }
		</style>
		
		<!-- Bootstrap and JQuery -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
	</head>
	<body>
	
		<div id="container">
			<div class="row">
				<div class="col-xs-8 col-sm-6 col-md-10 col-lg-10">
					<h1><?php echo $conf->meta->site_name . " " . $serverStatus; ?></h1>
				</div>
			</div>
		
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><h3>Player ID <a href="?sortBy=id_asc" title="ID ascending">▲</a><a href="?sortBy=id_desc" title="ID descending">▼</a></h3></th>
						<th><h3>Privilege Level <a href="?sortBy=pl_asc" title="Privilege Level ascending">▲</a><a href="?sortBy=pl_desc" title="Privilege Level descending">▼</a></h3></th>
						<th><h3>Last Update Time <a href="?sortBy=ut_asc" title="LUT ascending">▲</a><a href="?sortBy=ut_desc" title="LUT descending">▼</a></h3></th>
						<th><h3>Edit User</h3></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (!$dbc->queryDB($sql)) {
					echo $dbc->errors()."<br />";
				} else {
					$databaseResponse = $dbc->queryDB($sql);
					while($row = mysqli_fetch_array($databaseResponse)){ //Construct bootstrap table with data
						$avatarDecoded = json_decode($row["Avatar"]);
						$playerName = $avatarDecoded->{"avatar_name"};
						
						echo "<tr>
						<td>" . $row["PlayerId"] . "</td>
						<td>" . $row["AccountPrivileges"] . "</td>
						<td>" . $row["LastUpdateTime"] . "</td>
						<td><a title=\"Edit User\" href=\"user.php?id=" . $row["PlayerId"] . "\">" . $playerName . " ►</a></td></tr></a>\n";
					}
				}
				?>
				</tbody>
			</table>
			<center>
				<?php if ($currentPage == 0) { echo '
				<ul class="pagination">
					<li><a href="?page=1">Next Page</a></li>
				</ul>'; } else { echo '
				<ul class="pagination">
					<li><a href="?page=' . ($currentPage-1) . '">Previous</a></li>
					<li><a href="#">Current Page: ' . ($currentPage+1) . '</a></li>
					<li><a href="?page=' . ($currentPage+1) . '">Next</a></li>
				</ul>'; } ?>
			</center>
		</div>
	</body>
</html>
<?php $dbc->disconnect(); ?>
