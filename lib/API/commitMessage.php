<?php
var_dump ( $_POST ['chatMessage'] );
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/user/SiteUser.php";
$data = Array ();
$con = (new MySQL ())->getConnection ();
$req = $con->prepare ( "INSERT INTO `icommission_conversations` (`ID`, `sender`, `receiver`, `text`) VALUES (NULL, ?, ?, ?)" );
$foo = "12";
$sender = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$USER = new siteUser ( $sender );
$data ['from_username'] = $USER->getName ();
$data ['from_user_avatar'] = $USER->getAvatar ();
$data ['key'] = "USER_MESSAGE_GET";
$req->bind_param ( "sss", $sender, $foo, htmlspecialchars ( $_POST ['chatMessage'] ) );
$req->execute ();
$req = $con->prepare ( "INSERT INTO `iComission_Alert` (`ID`, `toUser`, `type`, `subject`, `message`,`JSON`) VALUES (NULL, ?, ?, ?, ?,?)" );
if ($USER->isOnline ()) {
	$type = "PUSH";
} else {
	$type = "SOFT";
}
$subject = $USER->getName () . " has sent you a message";
$message = htmlspecialchars ( $_POST ['chatMessage'] );
$JSON = json_encode ( $data );
$req->bind_param ( "sssss", $sender, $type, $subject, $message, $JSON );
$req->execute ();