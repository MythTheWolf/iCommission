<?php
$userdata = Array ();
$data;
$return = Array ();
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/user/SiteUser.php";
$class = new MySQL ();
$con = $class->getConnection ();
$self = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$partner = siteUser::convertToId ( $_COOKIE ['USERNAME'] );
$message = Array ();
$alreadyGot = Array ();
$sql = 'SELECT * FROM(SELECT * FROM `iCommission_Conversations` WHERE (`sender` = "' . $self . '") OR (`receiver` = "' . $self . '") ORDER BY `ID` DESC LIMIT 10) `icommission_conversations` ORDER BY `ID` ASC';
if (! $result = $con->query ( $sql )) {
	die ( 'There was an error running the query [' . $con->error . ']' );
}

while ( $row = $result->fetch_assoc () ) {
	if (! in_array ( $row ['sender'] . "/" . $row ['receiver'], $alreadyGot ) && ! in_array ( $row ['receiver'] . "/" . $row ['sender'], $alreadyGot )) {
		$alreadyGot [] = $row ['sender'] . "/" . $row ['receiver'];
		$message ['username'] = (new siteUser ( $row ['sender'] ))->getName ();
		$message ['avatar'] = (new siteUser ( $row ['sender'] ))->getAvatar ();
		$sql = 'SELECT * FROM(SELECT * FROM `iCommission_Conversations` WHERE (`sender` = "' . $self . '") OR (`receiver` = "' . $self . '") ORDER BY `ID` DESC LIMIT 1) `icommission_conversations` ORDER BY `ID` ASC';
		if (! $result2 = $con->query ( $sql )) {
			die ( 'There was an error running the query [' . $con->error . ']' );
		}
		while ( $row2 = $result2->fetch_assoc () ) {
			$message ['lastContent'] = $row2 ['text'];
		}
		$messages[] = $message;
	}
}

$return ['conversations'] = $messages;
die ( json_encode ( $return ) );
?>