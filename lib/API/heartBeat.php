<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
$con = (new MySQL())->getConnection();
$SQL = "UPDATE `icomission_user` SET `lastSeen` = ?, `online` = ? WHERE `ID` = ?";
$req = $con->prepare($SQL);
$today = date ( "Y-m-d H:i:s" ) ;
$on = "true";
$req->bind_param("sss", $today,$on,$_GET['id']);
$req->execute();