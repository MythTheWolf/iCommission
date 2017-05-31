<?php
require_once $_SERVER['DOCUMENT_ROOT']."/lib/config/MySQL.php";
$con = (new MySQL())->getConnection();
$req = $con->prepare("UPDATE `icomission_alert` SET `type` = ? WHERE `ID` = ?");
$type = $_GET['type'];
$id = $_GET['id'];
$req->bind_param("ss", $type,$id);
$req->execute();
