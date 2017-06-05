<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/tool/php_bootstrap.php";
$con = (new MySQL())->getConnection();
$part = $_POST['selectedChat'];
$self = siteUser::convertToId($_COOKIE['USERNAME']);
$sql = 'SELECT * FROM `iCommission_Conversations` WHERE (`sender` = "'.$self.'" OR `toSendTo` = "'.$self.'") AND (`sender` = "'.$part.'" OR `toSendTo` = "'.$part.'") ORDER BY `ID` ASC LIMIT 5';
if (! $result = $con->query ( $sql )) {
	die ( "There was an error running the query [" . $db->error . ']' );
}
while ( $row = $result->fetch_assoc () ) {
	$mData['sender'] = $row['sender'];
	$mData['senderAvatar'] = (new siteUser($row['sender']))->getAvatar();
	$mData['senderName'] = (new siteUser($row['sender']))->getName();
	$mData['text'] = $row['text'];
	$messages[] = $mData;
} 
$messages;
$mData;
$return['messages'] = $messages;
die(json_encode($return));