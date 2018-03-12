<?php
class  db{
	function __construct(){
		$this->mysqli= new mysqli("localhost", "root", "", "blog");

		if ($this->mysqli->connect_error) {
				die('Connect Error (' . $this->mysqli->connect_errno . ') '
			        . $this->mysqli->connect_error);
			}
		$this->query('set names utf8');
		}
	function query($sql){
		return $this->mysqli->query($sql);
		}
	}
?>