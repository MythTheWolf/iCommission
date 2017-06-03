<?php
class SocketBuilder {
	private $return = Array ();
	private $actMessage;
	function __construct() {
	}
	function setKey($key) {
		$this->return ['key'] = $key;
	}
	function setScope($scope) {
		$this->return ['scope'] = $scope;
	}
	function appendData($key, $val) {
		$this->actMessage [$key] = $val;
	}
	function toJSON() {
		$this->return ['value'] = json_encode ( $this->actMessage );
		return json_encode ( $this->return );
	}
}
