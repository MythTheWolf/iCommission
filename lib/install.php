<?php
require_once __DIR__ . '/config/MySQL.php';
$MYSQL = new MySQL ();
$connection = $MYSQL->getConnection ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_User` ( `ID` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `gender` VARCHAR(255) NULL DEFAULT 'n/a' , `about` TEXT NULL , `open` VARCHAR(255) NOT NULL DEFAULT 'true' , `status` VARCHAR(255) NOT NULL DEFAULT 'OK', `group` VARCHAR(255) NOT NULL DEFAULT 'default' , PRIMARY KEY (`ID`)) ENGINE = InnoDB";
$req = $connection->prepare ( $SQL );
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_User_Commissions` ( `ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL ,`catagory_id` VARCHAR(255) NOT NULL, `step_entryID` VARCHAR(255) NOT NULL , `artist` VARCHAR(255) NOT NULL , `endUser` VARCHAR(255) NOT NULL , `description` VARCHAR(255) NOT NULL , `dateStart` VARCHAR(255) NOT NULL , `projectedEnd` VARCHAR(255) NOT NULL , `private` INT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_commission_requests` ( `ID` INT NOT NULL AUTO_INCREMENT , `artist` VARCHAR(255) NOT NULL ,`fromUser` VARCHAR(255) NOT NULL , `catagoryID` VARCHAR(255) NOT NULL , `notes` TEXT NULL DEFAULT NULL , `state` VARCHAR(255) NULL DEFAULT 'OPEN' , `reply` TEXT NULL DEFAULT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
die ( "All setup!" );