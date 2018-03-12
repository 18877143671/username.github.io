<?php
include('check.php');
if($input->get( 'do' )=='edit' ){
	$update_seting = $input->post();
	var_dump($update_seting);
	foreach( $update_seting as $key=>$val){	
		$sql = "update seting set val='{$val}' where `key`='{$key}'";
		$is = $db->query( $sql );
		if($is){
			header("locating:seting.php");
		}else{
			die('执行失败');
		}
		
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
	<h1>系统设置 <small class='pull-right'></small></h1>
	<hr/>
		<div class="rows">
			
			<form class="form-horizontal" action="seting.php?do=edit" method="post">
			<?php foreach($seting as $ky=>$val):?>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $ky;?></label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name="<?php echo $ky; ?>" placeholder="账号" value='<?php echo $val; ?>'/>
			    </div>
			  </div>
			<?php endforeach;?>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-4">
			      <button type="submit" class="btn btn-default">确定</button>
			    </div>
			  </div>
			</form>
		</div>
			
	</div>
</body>

</html>