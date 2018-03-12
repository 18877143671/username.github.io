<?php

define("PAT",dirname(__FILE__));

include(PAT . '/core/db.class.php');
$db=new db();

include(PAT . '/core/input.class.php');
$input=new input;


//读取系统配置显示数
$sql="select *  from seting";
$set_result=$db->query( $sql );
$seting = array();
while($row = $set_result->fetch_array( MYSQL_ASSOC) ){
	$seting[ $row['key'] ] = $row['val'];
}
?>