<?php
if (empty ( $_POST ['currentDate'] )) {
	die ( "Unauthorized." );
}
require_once $_SERVER ['DOCUMENT_ROOT'] . '/lib/config/MySQL.php';
$artist = $_COOKIE ['USERNAME'];
if (empty ( $artist )) {
	die ( "error: couldn't grab username.." );
}
$mySQL = new MySQL ();
$db = $mySQL->getConnection ();
$final = Array ();
$return ['numPastDue'] = 0;
$return ['numUnansweredRequets'] = 0;
$overDue;
$overDues = Array ();
$sql = "SELECT * FROM `icomission_user_commissions` WHERE `artist` = \"" . $artist . "\"";
if (! $result = $db->query ( $sql )) {
	die ( "There was an error running the query [" . $db->error . ']' );
}

while ( $row = $result->fetch_assoc () ) {
	$now = new DateTime ( $_POST ['currentDate'] );
	$due = new DateTime ( $row ['projectedEnd'] );
	
	if ($now >= $due) {
		$return ['numPastDue'] ++;
		$overDue ['dateStart'] = $row ['dateStart'];
		$overDue ['endUser'] = $row ['endUser'];
		$overDue ['desc'] = $row ['description'];
		$overDue ['projectedEnd'] = $row ['projectedEnd'];
		$overDue ['id'] = $row ['ID'];
		$overDue['name'] = $row['name'];
		$overDue ['isWarning'] = false;
		$overDues [] = $overDue;
	} else {
		date_add ( $now, date_interval_create_from_date_string ( "7 days" ) );
		if ($now > $due) {
			
			$overDue ['dateStart'] = $row ['dateStart'];
			$overDue ['endUser'] = $row ['endUser'];
			$overDue ['desc'] = $row ['description'];
			$overDue ['projectedEnd'] = $row ['projectedEnd'];
			$overDue ['id'] = $row ['ID'];
			$overDue ['isWarning'] = "true";
			$overDue['name'] = $row['name'];
			$overDues [] = $overDue;
		}
	}
}
$return ['overDues'] = $overDues;
$sql = "SELECT * FROM `iComission_commission_requests` WHERE `artist` = \"" . $artist . "\" AND `state` = \"OPEN\"";
if (! $result = $db->query ( $sql )) {
	die ( 'There was an error running the query [' . $db->error . ']' );
}

while ( $row = $result->fetch_assoc () ) {
	$return ['numUnansweredRequets'] ++;
}

echo json_encode ( $return );