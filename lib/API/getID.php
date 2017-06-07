<?php 
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/tool/php_bootstrap.php";
die(siteUser::convertToId($_GET['username']));