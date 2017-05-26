<?php
if ($_COOKIE ['LOGGED_IN'] == "false" || empty($_COOKIE ['LOGGED_IN'])) {
	header ( 'Location: /' );
	die ();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/user/SiteUser.php';
$USER = new siteUser($_COOKIE['USERNAME']);