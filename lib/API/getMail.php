<?php
$userdata = Array ();
$data;
$return = Array();
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/user/SiteUser.php";
$class = new MySQL ();
$con = $class->getConnection ();
$self = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$partner = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$message;
$sql = 'SELECT * FROM(SELECT * FROM `iCommission_Conversations` WHERE (`sender` = "' . $self . '" OR `sender` = "' . $partner . '") OR (`receiver` = "' . $self . '" OR `receiver` = "' . $partner . '") ORDER BY `ID` DESC LIMIT 4) `icommission_conversations` ORDER BY `ID` ASC';
if (! $result = $con->query ( $sql )) {
	die ( 'There was an error running the query [' . $con->error . ']' );
}
$user = new siteUser($self);
$user2 = new siteUser($partner);
$data['avatar'] = $user->getAvatar();
$data['username'] = $user->getName();
$userdata[] = $data;
$data['avatar'] = $user2->getAvatar();
$data['username'] = $user2->getName();
$userdata[] = $data;
$return['userData'] = $userdata;
$messages = Array();
while ( $row = $result->fetch_assoc () ) {
	$message['senderName'] = (new siteUser($row['sender']))->getName();	
	$message['getter'] = $row['receiver'];
	$message['content'] = $row['text'];
	$message['id'] = $row['ID'];
	$messages[] = $message;
}
$return['messages'] = $messages;
die(json_encode($return));
?>