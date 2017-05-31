<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
$UN = $_POST ['login'];
$PASS = sha1 ( $_POST ['password'] );
$MySQL = new MySQL ();
$con = $MySQL->getConnection ();
$req = $con->prepare ( "SELECT * FROM `iComission_User` WHERE `username` = ? AND `password` = ?" );
if(!$req){
	die("error ");
	print_r($con->error);
}
$req->bind_param ( "ss", $UN, $PASS );
$req->execute ();

$results = $req->fetch ();
if ($results) {
	die ( "OK" );
} else {
	die ( "INVALID" );
}
?>