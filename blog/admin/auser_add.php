<?php
include("check.php");


$aid=$input->get('aid');
$auser=array(
	'auser'=>'',
	'apass'=>'',
	);
if($aid>0){
	$sql="select * from admin where aid='{$aid}'";
	$res=$db->query( $sql );
	$auser=$res->fetch_array( MYSQL_ASSOC );
	

}




if($input->get('do')=='add'){
	$auser=$input->post('auser');
	$apass=$input->post('apass');	
	if(empty($auser)||empty($apass)){
		die( '用户和密码不能为空');
	}

	//判断账号是否重复
	$sql="select * from admin where auser='{$auser}'and aid<>'{$aid}'";	
	$res=$db->query($sql);	
	if( $res->fetch_array() ){
		die('账号已存在');
	}
	if( $aid<1 ){
		$sql="insert into admin (auser,apass) values('{$auser}','{$apass}')";
	}else{
		$sql="UPDATE admin SET auser='{$auser}',apass='{$apass}' where aid='{$aid}'";
	}
	
	$is=$db->query( $sql );
	if($is){
		header("location:auser.php");
	}else{
		die( "添加失败");
	}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include(PAT . "/healder.php");
?>
</head>
<body>
<?php include('nav.inc.php');?>

	<div class="container">
	<h1>管理员添加 <small class='pull-right'><a class='btn btn-default' href="auser.php">返回</a></small></h1>
	<hr/>
		<div class="rows">
			<form class="form-horizontal" action="auser_add.php?do=add&aid=<?php echo $aid;?>" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"></label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name='auser' placeholder="账号" value='<?php echo $auser['auser'];    ?>'/>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"></label>
			    <div class="col-sm-4">
			      <input type="password" class="form-control" name='apass' placeholder="密码" value='<?php echo $auser['apass'];    ?>'/>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-4">
			      <button type="submit" class="btn btn-default">添加</button>
			    </div>
			  </div>
			</form>
		</div>
			
	</div>
</body>

</html>

