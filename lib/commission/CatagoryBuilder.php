<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
class CatagoryBuilder {
	private $spotsAvailible;
	private $spotsTaken;
	private $name;
	private $description;
	private $owner;
	private $MySQL;
	private $con;
	private $price;
	function __construct($name) {
		$this->MySQL = new MySQL ();
		$this->con = $this->MySQL->getConnection ();
		$this->name = $name;
	}
	function setSpotsAvail($val) {
		$this->spotsAvailible = $val;
	}
	function setDesc($val) {
		$this->description = $val;
	}
	function setPrice($val) {
		$this->price = $val;
	}
	function setOwnerId($val) {
		$this->owner = $val;
	}
	function buildAndInsert() {
		$SQL = "INSERT INTO `iComission_User_Catagories` (`name`,`description`,`artist`,`maxSpots`,`price`) VALUES (?,?,?,?,?);";
		$req = $this->con->prepare ( $SQL );
		$req->bind_param ( "sssss", $this->name, $this->description, $this->owner, $this->spotsAvailible, $this->price );
		$req->execute ();
	}
}
