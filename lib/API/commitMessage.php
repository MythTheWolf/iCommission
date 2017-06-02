<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/tool/php_bootstrap.php";
$data = Array ();
$con = (new MySQL ())->getConnection ();
$req = $con->prepare ( "INSERT INTO `icommission_conversations` (`ID`, `sender`, `receiver`, `text`) VALUES (NULL, ?, ?, ?)" );
$foo = "12";
$sender = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$req->bind_param ( "sss", $sender, $foo, htmlspecialchars ( $_POST ['chatMessage'] ) );
$req->execute ();
$builder = new SocketBuilder();
$builder->setReceiver($sender);
$builder->setScope("USER_MESSAGE_NOTIF");
$builder->setUser($sender);
$builder->append("message", htmlspecialchars ( $_POST ['chatMessage'] ));
$builder->append("subject", "User sent message");
die($builder->toJSON());