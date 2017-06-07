<?php
class SocketBuilder {
	private $return = Array ();
	private $actMessage;
	private $onlineScope;
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
	function setStatusCases($case,$what){
		$this->cases[$case] = $what;
	}
	function toJSON() {
		$this->return ['value'] = json_encode ( $this->actMessage );
		return json_encode ( $this->return );
	}
}
