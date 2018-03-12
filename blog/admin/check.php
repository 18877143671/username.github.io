<?php
ini_set('date.timezone','Asia/Shanghai');
session_start();
include('../config.php');

$session_aid=$input->session('aid');

if(!$session_aid){
	
	header("location:login.php");
	
	}

$sql="select * from admin where aid='{$session_aid}'";
$session_auser_result=$db->query($sql);
$session_auser=$session_auser_result->fetch_array(MYSQL_ASSOC);



?>