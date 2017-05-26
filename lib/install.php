<?php
require_once __DIR__ . '/config/MySQL.php';
$MYSQL = new MySQL();
$connection = $MYSQL->getConnection();
$SQL = "CREATE TABLE `iComission_User` ( `ID` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `gender` VARCHAR(255) NULL DEFAULT 'n/a' , `characters` TEXT NULL , `about` VARCHAR(255) NOT NULL DEFAULT 'No bio yet..' , `location` VARCHAR(255) NULL DEFAULT NULL , `group` VARCHAR(255) NOT NULL DEFAULT 'default' , PRIMARY KEY (`ID`)) ENGINE = InnoDB";
$req = $connection->prepare($SQL);
$req->execute ();
die("All setup!");