<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
class Commission {
	private $owner;
	private $artist;
	private $catagory;
	private $name;
	private $desc;
	private $expectedEnd;
	private $step;
	private $startDate;
	private $nonPublic;
	private $con;
	private $MySQL;
	function __construct($id) {
		$this->MySQL = new MySQL ();
		$this->con = $this->MySQL->getConnection ();
		$sql = "SELECT * FROM `icomission_user_commissions` WHERE `ID` = \"" . $id . "\"";
		if (! $result = $this->con->query ( $sql )) {
			die ( "There was an error running the query [" . $this->con->error . ']' );
		}
		while ( $row = $result->fetch_assoc () ) {
			$this->owner = $row ['endUser'];
			$this->artist = $row ['artist'];
			$this->catagory = $row ['catagory_id'];
			$this->name = $row ['name'];
			$this->desc = $row ['description'];
			$this->expectedEnd = $row ['projectedEnd'];
			$this->step = $row ['step_entryID'];
			$this->startDate = $row ['startDate'];
			$this->nonPublic = $row ['public'];
		}
	}
	function getOwnerId(){
		return $this->owner;
	}
	function getArtistId(){
		return $this->artist;
	}
	function getCatagiryId(){
		return $this->catagory;
	}
	function getName(){
		return $this->name;
	}
	function getDesc(){
		return $this->desc;
	}
	function getProjectedEnd(){
		return $this->expectedEnd;
	}
	function getStepId(){
		return $this->step;
	}
	function getStartDate(){
		return $this->startDate;
	}
	function isPublic(){
		return ($this->nonPublic == "true");
	}
}
?>