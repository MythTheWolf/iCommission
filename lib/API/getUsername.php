<?php 
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/tool/php_bootstrap.php";
$USER = new siteUser($_GET['ID']);
if(!$USER->exists()){
	die("ERROR->NOTFOUND");
}else{
	die($USER->getName());
}