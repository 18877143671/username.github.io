<?php
	include("check.php");
	$pid=$input->get('pid');
	$page=array(
	'title'	 =>'',
	'author' =>'',
	'content'=>'',
	);
if($pid>0){
	$sql="select * from page where pid='{$pid}'";
	$res=$db->query( $sql );
	$page=$res->fetch_array( MYSQL_ASSOC );
	
	}


	if($input->get('do')=='add'){

	$title=$input->post('title');
	
	$author=$input->post('author');
	
	$content=$input->post('content');	
		if(empty( $title )||empty( $author )||empty( $content )){
			die( '数据不能为空');
		}

	
	
	if($pid>0){
	$uptime = time();
	
	$sqlTpl = "UPDATE page set title='%s',author='%s',content='%s',uptime='%d'where pid='%d'";

	$sql = sprintf( $sqlTpl, $title, $author, $content, $uptime,$pid);
	
	}else{
	
	$intime = time();
	$sqlTpl = "INSERT INTO page (`title`,`author`,`content`,`intime`,`uptime`) values ('%s','%s','%s','%d','%d')";
	$sql = sprintf( $sqlTpl, $title, $author, $content, $intime,0);
	

	}


	
	$is = $db->query($sql);

	
	if($is){
		header("location:blog.php");
	}else{
		die('执行失败');
	}

	}
?>
<!DOCTYPE html>
<html>
<head>
<title>登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	include(PAT . "/healder.php");?>

<link rel="stylesheet" type="text/css" href="../themes/simditor-2.3.6/styles/simditor.css" />

<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/module.js"></script>
<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/hotkeys.js"></script>
<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/uploader.js"></script>
<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/simditor.js"></script>
</head>
<body>
<?php include('nav.inc.php');?>

	<div class="container">
	<h1>博客添加 <small class='pull-right'><a class='btn btn-default' href="blog.php">返回</a></small></h1>
	<hr/>
		<div class="rows">
			<form class="form-horizontal" action="blog_add.php?do=add&pid=<?php  echo $pid; ?>" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"></label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name='title' placeholder="标题" value='<?php echo $page['title'];  ?>'/>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"></label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name='author' placeholder="作者" value='<?php echo $page['author'];   ?>'/>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"></label>
			    <div class="col-sm-8" >
			      <textarea  id='content' name="content" class="form-control" placeholder="请输入正文" ><?php echo $page['content'];   ?></textarea>
			      	<script>
						var editor = new Simditor({
						  textarea: $('#content'),
						  upload:{
						  	url:'blog_upload.php',
						  	fileKey:'file1'
						  }
						

						  //optional options
						});
			      	</script>
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