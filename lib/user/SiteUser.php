<?php
error_reporting(0);
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
class siteUser {
	private $username;
	private $gender;
	private $bio;
	private $group;
	private $email;
	private $status;
	private $open;
	function __construct($user) {
		$mySQL = new MySQL ();
		$db = $mySQL->getConnection ();
		
		$sql = "SELECT `gender`,`status`,`open`,`about`,`email` FROM `iComission_User`";
		if (! $result = $db->query ( $sql )) {
			die ( 'There was an error running the query [' . $db->error . ']' );
		}
		$this->username = $user;
		while ( $row = $result->fetch_assoc () ) {
			$this->gender = $row ['gender'];
			$this->status = $row ['status'];
			$this->open = $row ['open'];
			$this->bio = $row ['bio'];
			$this->email = $row ['email'];
		}
	}
	function getGender() {
		return $this->gender;
	}
	function getStatus() {
		return $this->status;
	}
	function getOpenStatus() {
		return $this->open;
	}
	function getBio() {
		return $this->bio;
	}
	function getEmail() {
		return $this->email;
	}
}