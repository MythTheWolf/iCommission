<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/user/SiteUser.php";
$con = (new MySQL ())->getConnection ();
$self = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$sql = "SELECT * FROM `iComission_Alert` WHERE toUser = \"" . $self . "\"";
if (! $result = $con->query ( $sql )) {
	die ( 'There was an error running the query [' . $con->error . ']' );
}
$message = Array ();
$data = Array ();
$return = Array ();
$pushes;
while ( $row = $result->fetch_assoc () ) {
	$data ['subject'] = $row ['subject'];
	$data ['content'] = $row ['message'];
	$jsonReturn = json_decode($row['JSON'],true);
	$data['sender_name'] = $jsonReturn['from_username'];
	$data['sender_avatar'] = $jsonReturn['from_user_avatar'];
	$data['id'] = $row['ID'];
	$data['key'] = $jsonReturn['key'];
	if ($row ['type'] == "PUSH") {
		$pushes [] = $data;
	}
}
$return ['pushNotifs'] = $pushes;
die ( json_encode($return) );