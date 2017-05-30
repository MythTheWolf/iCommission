<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
class CommissionBuilder {
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
	function __construct() {
		$this->MySQL = new MySQL ();
		$this->con = $this->MySQL->getConnection ();
	}
	function getOwnerId($val) {
		$this->owner = $val;
	}
	function getArtistId($val) {
		$this->artist = $val;
	}
	function getCatagiryId($val) {
		$this->catagory = $val;
	}
	function getName($val) {
		$this->namey = $val;
	}
	function getDesc($val) {
		$this->descy = $val;
	}
	function getProjectedEnd($val) {
		$this->expectedEndy = $val;
	}
	function getStepId($val) {
		$this->stepy = $val;
	}
	function getStartDate($val) {
		$this->startDatey = $val;
	}
	function isPublic($val) {
		$this->nonPublicy = $val;
	}
	function buildAndInsert() {
		$sql = "INSERT INTO `icomission_user_commissions` (`ID`, `name`, `catagory_id`, `step_entryID`, `artist`, `endUser`, `description`, `dateStart`, `projectedEnd`, `private`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)
Close
";
		$req = $this->con->prepare ( $sql );
		$req->bind_param ( "sssssssss", $this->name, $this->catagory, $this->step, $this->artist, $this->owner, $this->desc, $this->startDate, $this->expectedEnd, $this->nonPublic );
		$req->execute ();
	}
}
?>