<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
class CommissionCatagory {
	private $spotsAvailible;
	private $spotsTaken;
	private $name;
	private $description;
	private $owner;
	private $MySQL;
	private $con;
	private $price;
	function __construct($id) {
		$this->MySQL = new MySQL ();
		$this->con = $this->MySQL->getConnection ();
		$entriesFound = 0;
		$total = 0;
		$sql = "SELECT * FROM `icomission_user_commissions` WHERE `catagory_id` = \"" . $id . "\"";
		if (! $result = $this->con->query ( $sql )) {
			die ( "There was an error running the query [" . $this->con->error . ']' );
		}
		while ( $row = $result->fetch_assoc () ) {
			$entriesFound ++;
		}
		
		$sql = "SELECT * FROM `icomission_user_catagories` WHERE `ID` = \"" . $id . "\"";
		if (! $result = $this->con->query ( $sql )) {
			echo $sql;
			die ( "There was an error running the query [" . $this->con->error . ']' );
		}
		while ( $row = $result->fetch_assoc () ) {
			$total = $row ['maxSpots'];
			$this->description = $row ['description'];
			$this->name = $row ['name'];
			$this->price = $row ['price'];
			$this->owner = $row ['artist'];
		}
		$this->spotsAvailible = $total - $entriesFound;
	}
	
	function getSpotsAvail() {
		return $this->spotsAvailible;
	}
	function getDesc() {
		return $this->description;
	}
	function getName() {
		return $this->name;
	}
	function getPrice() {
		return $this->price;
	}
	function getOwnerId() {
		return $this->owner;
	}
}