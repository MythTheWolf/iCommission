<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
$UN = $_POST ['login'];
$PASS = sha1 ( $_POST ['password'] );
$MySQL = new MySQL ();
$con = $MySQL->getConnection ();
$req = $con->prepare ( "SELECT * FROM `iComission_User` WHERE `username` = ? AND `password` = ?" );
$req->bind_param ( "ss", $UN, $PASS );
$req->execute ();
if ($req->affected_rows == - 1) {
	die("INVALID");
}
?>