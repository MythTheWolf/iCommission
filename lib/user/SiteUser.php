<?php
error_reporting ( 0 );
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
class siteUser {
	private $username;
	private $gender;
	private $bio;
	private $group;
	private $email;
	private $status;
	private $open;
	private $avatarURL;
	private $online;
	private $exists;
	static function convertToId($name) {
		
		$sql = "SELECT * FROM `icomission_user` WHERE `username` = \"" . $name . "\"";
		$return = "ERROR->NOTFOUND";
		$db = (new MySQL ())->getConnection ();
		if (! $result = $db->query ( $sql )) {
			die ( 'There was an error running the query [' . $db->error . ']' );
		}
		
		while ( $row = $result->fetch_assoc () ) {
			
			$return = $row ['ID'];
		}
		return $return;
	}
	function __construct($user) {
		$this->exists = false;
		$mySQL = new MySQL ();
		$db = $mySQL->getConnection ();
		
		$sql = "SELECT * FROM `iComission_User` WHERE `ID` = \"" . $user . "\"";
		if (! $result = $db->query ( $sql )) {
			die ( 'There was an error running the query [' . $db->error . ']' );
		}
		while ( $row = $result->fetch_assoc () ) {
			$this->exists = true;
			$this->gender = $row ['gender'];
			$this->status = $row ['status'];
			$this->open = $row ['open'];
			$this->bio = $row ['bio'];
			$this->email = $row ['email'];
			$this->username = $row ['username'];
			$this->avatarURL = $row ['avatar'];
			$this->online = $row['online'];
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
	function getName() {
		return $this->username;
	}
	function getAvatar() {
		if ($this->avatarURL == NULL || empty($this->avatarURL) || $this->avatarURL == "null" || $this->avatarURL == "NULL") {
			return "/assets/image/logo-default.png";
		} else {
			return $this->avatarURL;
		}
	}
	function isOnline(){
		if($this->online == "true" || $this->online == true){
			return true;
		}else{
			return false;
		}
	}
	function exists(){
		return $this->exists;
	}
}