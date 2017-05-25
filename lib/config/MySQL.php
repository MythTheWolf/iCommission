<?php
class MySQL{
	private $theConnection;
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$this->theConnection = new mysqli($servername, $username, $password, "main");
		if($this->theConnection->connect_error){
			die("Database error!");
		}
	}
	function getConnection(){
		return $this->theConnection;
	}
}