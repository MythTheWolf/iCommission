<?php
require_once __DIR__ . '/config/MySQL.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/commission/CatagoryBuilder.php";
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/commission/CommissionCatagory.php";
$MYSQL = new MySQL ();
$connection = $MYSQL->getConnection ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_User` ( `ID` INT NOT NULL AUTO_INCREMENT ,`online` VARCHAR(255) NULL DEFAULT NULL, `username` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `gender` VARCHAR(255) NULL DEFAULT 'n/a' , `about` TEXT NULL , `open` VARCHAR(255) NOT NULL DEFAULT 'true' , `status` VARCHAR(255) NOT NULL DEFAULT 'OK', `group` VARCHAR(255) NOT NULL DEFAULT 'default',`avatar` VARCHAR(255) NULL DEFAULT NULL ,`lastSeen` VARCHAR(255) NULL DEFAULT NULL, PRIMARY KEY (`ID`)) ENGINE = InnoDB";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_User_Commissions` ( `ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL ,`catagory_id` VARCHAR(255) NOT NULL, `step_entryID` VARCHAR(255) NOT NULL , `artist` VARCHAR(255) NOT NULL , `endUser` VARCHAR(255) NOT NULL , `description` VARCHAR(255) NOT NULL , `dateStart` VARCHAR(255) NOT NULL , `projectedEnd` VARCHAR(255) NOT NULL , `private` INT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_commission_requests` ( `ID` INT NOT NULL AUTO_INCREMENT , `artist` VARCHAR(255) NOT NULL ,`fromUser` VARCHAR(255) NOT NULL , `catagoryID` VARCHAR(255) NOT NULL , `notes` TEXT NULL DEFAULT NULL , `state` VARCHAR(255) NULL DEFAULT 'OPEN' , `reply` TEXT NULL DEFAULT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_transactions` ( `ID` INT NOT NULL AUTO_INCREMENT ,`complete` VARCHAR(255) NOT NULL, `payer_user_id` VARCHAR(255) NOT NULL , `payment_id` VARCHAR(255) NOT NULL , `hash` VARCHAR(255) NOT NULL , `artist_user_id` VARCHAR(255) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_User_Catagories` ( `ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `description` VARCHAR(255) NOT NULL , `artist` VARCHAR(255) NOT NULL , `maxSpots` INT NOT NULL , `price` INT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iCommission_Conversations` ( `ID` INT NOT NULL AUTO_INCREMENT , `sender` VARCHAR(255) NOT NULL , `receiver` VARCHAR(255) NOT NULL , `text` LONGTEXT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
$SQL = "CREATE TABLE IF NOT EXISTS `iComission_Alert` ( `ID` INT NOT NULL AUTO_INCREMENT , `toUser` VARCHAR(255) NOT NULL , `subject` VARCHAR(255) NOT NULL , `type` VARCHAR(255) NOT NULL , `JSON` TEXT NULL ,`message` VARCHAR(255) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$req = $connection->prepare ( $SQL );
$req->execute ();
die ( "All setup!" );