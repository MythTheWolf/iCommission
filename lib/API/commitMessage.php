<?php
var_dump($_POST['chatMessage']);
require_once $_SERVER['DOCUMENT_ROOT']."/lib/config/MySQL.php";
require_once $_SERVER['DOCUMENT_ROOT']."/lib/user/SiteUser.php";
$con = (new MySQL())->getConnection();
$req = $con->prepare("INSERT INTO `icommission_conversations` (`ID`, `sender`, `receiver`, `text`) VALUES (NULL, ?, ?, ?)");
$foo = "12";
$sender = siteUser::convertToId($_COOKIE['USERNAME']);
$req->bind_param("sss", $sender, $foo,htmlspecialchars($_POST['chatMessage']));
$req->execute();