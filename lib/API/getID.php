<?php 
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/tool/php_bootstrap.php";
echo ($_SERVER['REQUEST_URI']);
die(siteUser::convertToId($_GET['username']));