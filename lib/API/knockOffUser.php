<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
$con = (new MySQL ())->getConnection ();
$SQL = "SELECT * FROM `icomission_user` WHERE `online` = \"true\"";
if (! $result = $con->query ( $SQL )) {
	die ( "error while executing user knock offs...." );
}
while ( $row = $result->fetch_assoc () ) {
	$today = date_create ( date ( "Y-m-d H:i:s" ) );
	$theirLast = date_create ( $row['lastSeen'] );
	date_add ( $theirLast, date_interval_create_from_date_string ( "2 minutes" ) );
	if ($today > $theirLast) {
		echo "KNOCK";
	
		$SQL = "UPDATE `icomission_user` SET `online` = \"false\" WHERE `ID` = \"".$row['ID']."\"";
		$con->query($SQL);
	}
}