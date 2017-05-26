<?php
require_once __DIR__ . '/config/MySQL.php';
$MYSQL = new MySQL();
$connection = $MYSQL->getConnection();
$SQL = "CREATE TABLE `iComission_User` ( `ID` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `gender` VARCHAR(255) NULL DEFAULT 'n/a' , `about` TEXT NULL , `open` VARCHAR(255) NOT NULL DEFAULT 'true' , `status` VARCHAR(255) NOT NULL DEFAULT 'OK', `group` VARCHAR(255) NOT NULL DEFAULT 'default' , PRIMARY KEY (`ID`)) ENGINE = InnoDB";
$req = $connection->prepare($SQL);
$req->execute ();
die("All setup!");