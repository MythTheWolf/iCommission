<?php 
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/tool/php_bootstrap.php";
$con = (new MySQL())->getConnection();
$self = siteUser::convertToId($_COOKIE['USERNAME']);
$has = Array();
$data;
$return;
$list;
$sql = 'SELECT * FROM `iCommission_Conversations` WHERE (`sender` = "'.$self.'" OR `toSendTo` = "'.$self.'") ORDER BY `ID` DESC';
if (! $result = $con->query ( $sql )) {
	die ( "There was an error running the query [" . $db->error . ']' );
}
$chosenConvo;
$isPicked;
while ( $row = $result->fetch_assoc () ) {
	if($row['sender'] == $self){
		if(!$isPicked){
			$chosenConvo = $row['toSendTo'];
			$isPicked = true;
		} 
		if(!in_array($row['toSendTo'], $has)){
			$data['icon'] = (new siteUser($row['toSendTo']))->getAvatar();
			$data['user'] =  (new siteUser($row['toSendTo']))->getName();
			$data['content'] = $row['text'];
			$data['id'] = $row['toSendTo'];
			$list[] = $data;
			$has[]  = $row['toSendTo'];
		}
	}else{
		if(!$isPicked){
			$chosenConvo = $row['sender'];
			$isPicked = true;
		} 
		if(!in_array($row['sender'], $has)){
			$data['icon'] = (new siteUser($row['sender']))->getAvatar();
			$data['user'] =  (new siteUser($row['sender']))->getName();
			$data['id'] = $row['sender'];
			$data['content'] = $row['text'];
			$list[] = $data;
			$has[] = $row['sender'];
		}
	}
}


$return['list'] = $list;
die(json_encode($return));