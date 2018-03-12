<?php
session_start();

include('../config.php');

if(/*isset($_GET['do']) && $_GET['do']*/$input->get('do')=='check'){
	$auser=$_POST['auser'];
	$apass=$_POST['apass'];

$sql="select * from admin where auser='{$auser}' and apass='{$apass}'";

$mysqli_result=$db->query($sql);

$row=$mysqli_result->fetch_array(MYSQLI_ASSOC);
	if(is_array($row)){
		$_SESSION['aid']=$row['aid'];

		header("Location:blog.php");
	}else{

		die('账号或密码错误');

	}
}





?>



<!DOCTYPE html>
<html>
<head>
<title>登录</title>
<meta charset="utf-8">
<?php
include(PAT . "/healder.php");?>
</head>
<body>
	<div class="container">
		<div class="row" style="margin-top:200px">	
			<div class="col-md-3"></div>
			<div class="col-md-6">
				

				<div class="panel panel-primary">
					<div class="panel-heading"> 登录界面</div>
					<div class="panel-body">


						<form class="form-horizontal" action="login.php?do=check" method="post">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
								<input type="text" class="form-control" name='auser' id="auser" placeholder="user">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
								<input type="password" class="form-control" name='apass' id="apass" placeholder="password"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-info btn-block" id="submit">登录</button>
								</div>
							</div>
						</form>	
					
					</div>


					<div class="panel-footer text-right">201799913</div>
				</div>





			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
	

</body>
</html>