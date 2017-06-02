<?php
class SocketBuilder {
	private $return = Array ();
	function __construct() {
	}
	function append($key, $val) {
		$this->return [$key] = $val;
	}
	function toJSON() {
		return json_encode ( $this->return );
	}
	function setScope($val) {
		$this->return ['scope'] = $val;
	}
	function setUser($userID) {
		$userData = Array ();
		$USER = new siteUser ( $userID );
		$userData ['icon'] = $USER->getAvatar ();
		$userData ['name'] = $USER->getName ();
		$this->return ['userData'] = $userData;
	}
	function setReceiver($userID) {
		$this->return ['wanted'] = $userID;
	}
}
